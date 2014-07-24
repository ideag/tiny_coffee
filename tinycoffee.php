	<?php 
/*
Plugin Name: tinyCoffee
Plugin URI: http://github.com/ideag/tiny_coffee
Description: Ask people for coffee money
Version: 0.1.4
Author: Arūnas Liuiza
Author URI: http://github.com/ideag
Text Domain: tinycoffee
Domain Path: /languages
*/

// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

/**
 * Main plugin class
 *
 */
class Tiny_Coffee {

	const VERSION = '0.1.4';

	/**
	 * Holds status
	 *
	 * @var bool
	 */
	protected static $active = false;

	/**
	 * Holds current option values
	 *
	 * @var array
	 */
	protected static $options = array();

	/**
	 * Holds includes dir path
	 *
	 * @var string
	 */
	protected static $includes_dir;


	public static function init() {
		self::$includes_dir = plugin_dir_path( __FILE__ ) . 'includes/';

		# i18n
		load_plugin_textdomain( 'tinycoffee', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		# Settings page
		require_once self::$includes_dir . 'options-data.php';
		require_once self::$includes_dir . 'options.php';
		$coffee_settings = new Tiny_Coffee_Options( Tiny_Coffee_Options_Data::get() );
		self::$options   = $coffee_settings->get();

		// No callbacks activated, nothing to do.
		if ( ! is_array( self::$options['callback_activate'] )
			|| empty( self::$options['callback_activate'] )
		) {
			return;
		}

		self::$active = true;
		self::activate_callbacks();
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );
	}


	public static function activate_callbacks() {
		// Activate callbacks
		$callbacks = self::$options['callback_activate'];
		// shortcode
		if ( isset( $callbacks['shortcode'] ) ) {
			add_shortcode( 'coffee', array( __CLASS__, 'shortcode' ) );
			add_shortcode( 'tiny_coffee', array( __CLASS__, 'shortcode' ) );
		}
		// widget
		if ( isset( $callbacks['widget'] ) ) {
			add_action( 'widgets_init', array( __CLASS__, 'widget' ) );
		}
		// modal view
		if ( isset( $callbacks['modal_view'] ) ) {
			add_action( 'wp_footer', array( __CLASS__, 'modal_view' ) );
		}
	}


	public static function scripts() {
		$dir_url = plugin_dir_url( __FILE__ );
		$suffix  = ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) ? '.min' : '';

		wp_register_script( 'jquery-noui-slider', $dir_url . 'js/nouislider.jquery.min.js', 'jquery', null, true );
		wp_enqueue_script( 'tinycoffee', $dir_url . 'js/tinycoffee' . $suffix . '.js', array( 'jquery', 'jquery-noui-slider' ), self::VERSION, true );

		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
		wp_enqueue_style( 'jquery-noui-slider', $dir_url . 'js/nouislider.jquery.min.css' );
		wp_enqueue_style( 'tinycoffee', $dir_url . 'css/tinycoffee' . $suffix . '.css', false, self::VERSION );
	}


	public static function modal_view( $attr ) {
		?>
			<div id="modal-container">
				<article class="modal-info modal-style-wide fade js-modal">
					<section class="modal-content">
						<a class="coffee_close" href="#"><i class="fa fa-times"></i><span class="hidden"><?php _e( 'Close', 'tinycoffee' ) ?></span></a>
						<?php echo Tiny_Coffee::shortcode( $attr ); ?>
					</section>
				</article>
			</div>
			<div class="modal-background fade">&nbsp;</div>
		<?php
	}


	public static function widget() {
		require_once self::$includes_dir . 'widget.php';
		register_widget( 'Tiny_Coffee_Widget' );
	}


	public static function tag( $attr = false ) {
		return Tiny_Coffee::shortcode( $attr );
	}


	public static function shortcode( $attr = false, $content = false ) {
		if ( ! self::$active ) {
			return false;
		}

		$settings = array();

		if ( empty( $attr ) ) {
			$attr = array();
		}

		foreach ( $attr as $key => $val ) {
			switch ( $key ) {
				case 'title'  : $key = 'coffee_title'; break;
				case 'text'   : $key = 'coffee_text'; break;
				case 'icon'   : $key = 'coffee_icon'; break;
				case 'price'  : $key = 'coffee_price'; break;
				case 'for'    : $key = 'paypal_text'; break;
				case 'test'   : $key = 'paypal_testing'; break;
				case 'success': $key = 'callback_success'; break;
				case 'cancel' : $key = 'callback_cancel'; break;
			}
			$settings[ $key ] = $val;
		}

		if ( ! empty( $content ) ) {
			$settings['coffee_text'] = $content;
		}

		return Tiny_Coffee::build( $settings );
	}


	public static function build( $settings = false ) {
		if ( empty( $settings ) ) {
			$settings = array();
		}

		$options = wp_parse_args( $settings, self::$options );

		$form_data = array(
			'business'      => $options['paypal_email'],
			'cmd'           => '_xclick',
			'rm'            => '2',
			'amount'        => 0,
			'return'        => $options['callback_success'],
			'cancel_return' => $options['callback_cancel'],
			'item_name'     => $options['paypal_text'],
			'currency_code' => $options['paypal_currency'],
			'no_shipping'   => 1,
			//'no_note'       => '1'
		);

		if ( ! empty( $options['paypal_testing'] ) ) {
			$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}
		else {
			$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
		}

		ob_start();
		?>
		<?php if ( ! empty( $options['widget'] ) ) : ?>
			<div class="tiny_coffee tiny_coffee_widget">
		<?php else : ?>
			<div class="tiny_coffee">
				<header class="modal-header">
					<h1><?php echo $options['coffee_title'] ?></h1>
				</header>
		<?php endif; ?>
				<?php printf(
					'<section class="modal-body" data-icon="%s" data-price="%s" data-rate="%s" data-currency="%s" data-hash="%s" data-default="%s">',
					esc_attr( $options['coffee_icon'] ),
					esc_attr( $options['coffee_price'] ),
					esc_attr( $options['paypal_exchange'] ),
					esc_attr( $options['coffee_currency'] ),
					esc_attr( $options['coffee_hash'] ),
					esc_attr( $options['coffee_default'] )
				) ?>
					<?php if ( ! empty( $options['coffee_text'] ) ) : ?>
						<div class="tiny_coffee_text">
							<?php echo wpautop( $options['coffee_text'] ) ?>
						</div>
					<?php endif; ?>
					<div class="tiny_coffee_slider"></div>
					<div class="right"><span class="count"></span> <small class="count2"></small></div>
					<form action="<?php echo esc_attr( $paypal_url ) ?>" method="post" class="tiny_coffee_form">
						<?php foreach ( $form_data as $key => $value ) : ?>
							<?php printf(
								'<input type="hidden" name="%s" value="%s"/>',
								esc_attr( $key ),
								esc_attr( $value )
							) ?>
						<?php endforeach; ?>
						<button type="submit"><i class="fa fa-shopping-cart"></i></button>
					</form>
				</section>
			</div>
		<?php
		return ob_get_clean();
	}
}

add_action( 'plugins_loaded', array( 'Tiny_Coffee', 'init' ) );

function get_coffee( $options ) { return Tiny_Coffee::tag( $options ); }
function the_coffee( $options ) { echo Tiny_Coffee::tag( $options ) ; }
