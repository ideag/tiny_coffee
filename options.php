<?php 

/**
 * Tiny Coffee Options
 */
class Tiny_Coffee_Options {

	protected $data = array();

	protected $o = array();

	protected static $icons = array(
		'coffee', 'beer', 'glass', 'money', 'music', 'search', 'envelope-o',
		'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list',
		'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal',
		'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download',
		'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o',
		'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones',
		'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag',
		'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold',
		'italic', 'text-height', 'text-width', 'align-left', 'align-center',
		'align-right', 'align-justify', 'list', 'outdent', 'indent',
		'video-camera', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint',
		'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows',
		'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop',
		'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left',
		'chevron-right', 'plus-circle', 'minus-circle', 'times-circle',
		'check-circle', 'question-circle', 'info-circle', 'crosshairs',
		'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right',
		'arrow-up', 'arrow-down', 'share', 'expand', 'compress', 'plus',
		'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire',
		'eye', 'eye-slash', 'exclamation-triangle', 'plane', 'calendar',
		'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet',
		'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h',
		'bar-chart-o', 'twitter-square', 'facebook-square', 'camera-retro',
		'key', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half',
		'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack',
		'external-link', 'sign-in', 'trophy', 'github-square', 'upload',
		'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square',
		'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss',
		'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right',
		'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left',
		'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe',
		'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'users',
		'link', 'cloud', 'flask', 'scissors', 'files-o', 'paperclip',
		'floppy-o', 'square', 'bars', 'list-ul', 'list-ol', 'strikethrough',
		'underline', 'table', 'magic', 'truck', 'pinterest',
		'pinterest-square', 'google-plus-square', 'google-plus', 'caret-down',
		'caret-up', 'caret-left', 'caret-right', 'columns', 'sort', 'sort-asc',
		'sort-desc', 'envelope', 'linkedin', 'undo', 'gavel', 'tachometer',
		'comment-o', 'comments-o', 'bolt', 'sitemap', 'umbrella', 'clipboard',
		'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md',
		'stethoscope', 'suitcase', 'bell-o', 'cutlery', 'file-text-o',
		'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet',
		'h-square', 'plus-square', 'angle-double-left', 'angle-double-right',
		'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right',
		'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile',
		'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'reply',
		'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o',
		'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered',
		'terminal', 'code', 'reply-all', 'mail-reply-all', 'star-half-o',
		'location-arrow', 'crop', 'code-fork', 'chain-broken', 'question',
		'info', 'exclamation', 'superscript', 'subscript', 'eraser',
		'puzzle-piece', 'microphone', 'microphone-slash', 'shield',
		'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn',
		'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up',
		'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt',
		'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle',
		'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down',
		'check-square', 'pencil-square', 'external-link-square',
		'share-square', 'compass', 'caret-square-o-down', 'caret-square-o-up',
		'caret-square-o-right', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'rub',
		'krw', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc',
		'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc',
		'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square',
		'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox',
		'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket',
		'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down',
		'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple',
		'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare',
		'trello', 'female', 'male', 'gittip', 'sun-o', 'moon-o', 'archive',
		'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange',
		'arrow-circle-o-right', 'arrow-circle-o-left', 'caret-square-o-left',
		'dot-circle-o', 'wheelchair', 'vimeo-square', 'try', 'plus-square-o',
	);


	public static function get_icon_names() {
		return array_combine( self::$icons, self::$icons );
	}


	public function __construct() {
		$this->data = array(
			'page_title'        => __( 'tinyCoffee Options', 'tinycoffee' ),
			'page_description'  => false,
			'menu_title'        => __( 'tinyCoffee', 'tinycoffee' ),
			'permission'        => 'manage_options',
			'menu_slug'         => 'tiny_coffee_options',
			'option_name'       => 'tiny_coffee_options',
			'plugin_path'       => 'tiny_coffee_options',
			'defaults'          => array(
				'coffee_title'      => __( 'Buy me a cup of coffee', 'tinycoffee' ),
				'coffee_text'       => __( 'A ridiculous amount of coffee was consumed in the process of building this project. Add some fuel if you\'d like to keep me going!', 'tinycoffee' ),
				'coffee_icon'       => 'coffee',
				'coffee_currency'   => '€%s',
				'coffee_price'      => '2',
				'coffee_hash'       => '#coffee',
				'paypal_email'      => '',
				'paypal_currency'   => 'EUR',
				'paypal_exchange'   => 1,
				'paypal_text'       => sprintf( _x( 'A coffee for %s', 'Blog Title', 'tinycoffee' ), get_bloginfo( 'title' ) ),
				'paypal_testing'    => false,
				'callback_success'  => get_bloginfo( 'url' ),
				'callback_cancel'   => get_bloginfo( 'url' ),
				'callback_activate' => array(
					'template_tag' => true,
					'widget'       => true,
					'modal_view'   => true,
					'shortcode'    => true
				),
			),
			'section'           => array(
				array(
					'slug'  => 'coffee',
					'title' => __( 'Main Settings', 'tinycoffee' ),
					'field' => array(
						array(
							'slug'        => 'title',
							'title'       => __( 'Default title', 'tinycoffee' ),
							'type'        => 'text'
						),
						array(
							'slug'        => 'text',
							'title'       => __( 'Default text', 'tinycoffee' ),
							'type'        => 'textarea'
						),
						array(
							'slug'        => 'icon',
							'title'       => __( 'Default icon', 'tinycoffee' ),
							'type'        => 'select',
							'description' => sprintf(
								__( 'You can choose any %s icon', 'tinycoffee' ),
								'<a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a>'
							),
							'options'     => array(
								'list' => self::get_icon_names(),
							),
						),
						array(
							'slug'        => 'hash',
							'title'       => __( 'Hash', 'tinycoffee' ),
							'type'        => 'text',
						),
						array(
							'slug'        => 'currency',
							'title'       => __( 'Currency template', 'tinycoffee' ),
							'type'        => 'text',
						),
						array(
							'slug'        => 'price',
							'title'       => __( 'Coffee price', 'tinycoffee' ),
							'type'        => 'text',
							'description' => __( 'How much is a single cup of your favorite coffee?', 'tinycoffee' ),
						),
					),
				),
				array(
					'slug'  => 'paypal',
					'title' => __( 'Paypal Settings', 'tinycoffee' ),
					'field' => array(
						array(
							'slug'  => 'email',
							'title' => __( 'Paypal username', 'tinycoffee' ),
							'type'  => 'text'
						),
						array(
							'slug'  => 'currency',
							'title' => __( 'Paypal currency', 'tinycoffee' ),
							'type'  => 'text'
						),
						array(
							'slug'  => 'exchange',
							'title' => __( 'Exchange rate', 'tinycoffee' ),
							'type'  => 'text'
						),
						array(
							'slug'  => 'text',
							'title' => __( 'Payment text', 'tinycoffee' ),
							'type'  => 'text'
						),
						array(
							'slug'  => 'testing',
							'title' => __( 'Sandbox mode', 'tinycoffee' ),
							'type'  => 'checkbox'
						),
					)
				),
				array(
					'slug'  => 'callback',
					'title' => __( 'Callback Settings', 'tinycoffee' ),
					'field' => array(
						array(
							'slug'    => 'success',
							'title'   => __( 'Success callback', 'tinycoffee' ),
							'type'    => 'text'
						),
						array(
							'slug'    => 'cancel',
							'title'   => __( 'Cancel callback', 'tinycoffee' ),
							'type'    => 'text'
						),
						array(
							'slug'    => 'activate',
							'title'   => __( 'Activate', 'tinycoffee' ),
							'type'    => 'checkbox_list',
							'options' => array(
								'list' => array(
									'template_tag' => __( 'Template tag', 'tinycoffee' ),
									'shortcode'    => __( 'Shortcode', 'tinycoffee' ),
									'modal_view'   => __( 'Modal dialog', 'tinycoffee' ),
									'widget'       => __( 'Widget', 'tinycoffee' ),
								),
							),
						),
					),
				),
			),
		);

		$this->load();

		add_action( 'admin_init', array( $this,'options' ) );
		add_action( 'admin_menu', array( $this,'pages' ) );
	}


	/**
	 * Register menu
	 */
	public function pages() {
		add_options_page(
			$this->data['page_title'],
			$this->data['menu_title'],
			$this->data['permission'],
			$this->data['menu_slug'],
			array( $this,'page' )
		);
	}


	public function defaults() {
		update_option( $this->data['option_name'], $this->data['defaults'] );
	}


	public function page(){
		?>
			<div class="wrap">
				<h2><?php echo esc_html( $this->data['page_title'] ); ?></h2>
				<?php if ( ! empty( $this->data['page_description'] ) ) : ?>
					<?php echo wpautop( $this->data['page_description'] ); ?>
				<?php endif; ?>

				<form method="post" action="options.php">
					<?php settings_fields( $this->data['option_name'] ); ?>
					<?php do_settings_sections( $this->data['plugin_path'] ); ?>
					<?php submit_button() ?>
				</form>
			</div>
		<?php
	}


	/**
	 * Register option
	 */
	public function options() {
		register_setting(
			$this->data['option_name'],
			$this->data['option_name'],
			array( $this,'validate' )
		);

		foreach ( $this->data['section'] as $section ) {
			add_settings_section( $section['slug'], $section['title'], '', $this->data['plugin_path'] );

			foreach ( $section['field'] as $field ) {
				$option_id = $this->get_field_id( $section['slug'], $field['slug'] );

				add_settings_field(
					$option_id,
					sprintf(
						'<label for="%s">%s</label>',
						esc_attr( $option_id ),
						esc_html( $field['title'] )
					),
					array( $this, 'the_field' ),
					$this->data['plugin_path'],
					$section['slug'],
					array(
						'option_type' => $field['type'],
						'option_id'   => $option_id,
						'description' => ! empty( $field['description'] ) ? $field['description'] : '',
						'options'     => isset( $field['options'] ) ? $field['options'] : false,
						'value'       => isset( $this->o[ "{$section['slug']}_{$field['slug']}" ] ) ? $this->o[ "{$section['slug']}_{$field['slug']}" ] : false,
					)
				);
			}
		}
	}


	public function get() {
		return get_option( $this->data['option_name'] );
	}


	public function load() {
		$this->o = get_option( $this->data['option_name'] );
	}


	public function get_field_id( $section_slug, $field_slug ) {
		return sprintf(
			'%s[%s_%s]',
			$this->data['option_name'],
			$section_slug,
			$field_slug
		);
	}


	public function validate( $values ) {
		foreach ( $this->data['section'] as $section ) {
			foreach ( $section['field'] as $field ) {
				$name = "{$section['slug']}_{$field['slug']}";
				$type = $field['type'];

				if ( ! isset( $values[ $name ] ) ) {
					$values[ $name ] = false;
				}
				// TODO: sanitize for every type;
			}
		}

		return $values;
	}


	public function the_field( $args ) {
		call_user_func( array( $this, $args['option_type'] ), $args );
		if ( ! empty( $args['description'] ) ) :
		?>
			<p class="description"><?php echo $args['description'] ?></p>
		<?php endif;
	}


	public function text( $args ) {
		printf(
			'<input class="regular-text" id="%1$s" name="%1$s" type="text" value="%2$s" />',
			esc_attr( $args['option_id'] ),
			esc_attr( $args['value'] )
		);
	}


	public function textarea( $args ) {
		printf(
			'<textarea class="all-options" id="%1$s" name="%1$s" rows="5">%2$s</textarea>',
			esc_attr( $args['option_id'] ),
			esc_html( $args['value'] )
		);
	}


	public function select( $args ) {
		printf( '<select id="%1$s" name="%1$s">', esc_attr( $args['option_id'] ) );
		foreach( $args['options']['list'] as $value => $label ) {
			printf(
				'<option value="%s"%s>%s</option>',
				esc_attr( $value ),
				selected( $args['value'], $value, false ),
				esc_attr( $label )
			);
		}
		printf( '</select>' );
	}


	public function checkbox( $args ) {
		printf(
			'<input id="%1$s" name="%1$s" type="checkbox" value="true"%2$s />',
			esc_attr( $args['option_id'] ),
			checked( $args['value'], 'true', false )
		);
	}


	public function checkbox_list( $args ) {
		foreach( $args['options']['list'] as $value => $label ) {
			$is_checked = ( isset( $args['value'][ $value ] ) && $args['value'][ $value ] );
			printf(
				'<label for="%1$s"><input id="%1$s" name="%1$s" type="checkbox" value="true"%2$s /> %3$s</label><br />',
				esc_attr( "{$args['option_id']}[{$value}]" ),
				checked( $is_checked, true, false ),
				esc_html( $label )
			);
		}
	}
}
