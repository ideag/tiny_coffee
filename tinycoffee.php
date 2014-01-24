<?php 
/*
Plugin Name: tinyCoffee
Plugin URI: http://github.com/ideag/tiny_coffee
Description: Ask people for coffee money
Version: 0.1
Author: Arūnas Liuiza
Author URI: http://github.com/ideag
Text Domain: tinycoffee
*/
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
  echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
  exit;
}

require_once(plugin_dir_path( __FILE__ ).'options.php');
$tiny_coffee_options = new Tiny_Coffee_Options();
$options = $tiny_coffee_options->get();


add_action('init', array('Coffee','scripts'));
// shortcode
if (isset($options['callback_activate']['shortcode'])) {
  add_shortcode( 'coffee', array('Coffee','shortcode') );
  add_shortcode( 'tiny_coffee', array('Coffee','shortcode') );
}
// template tags
if (isset($options['callback_activate']['template_tag'])) {
  function get_coffee($options) {return Coffee::tag($options);}
  function the_coffee($options) {echo Coffee::tag($options);}  
}
// widget
if (isset($options['callback_activate']['widget'])) {
  add_action( 'widgets_init', array('Coffee','widget') );
}
// modal view
if (isset($options['callback_activate']['modal_view'])) {
  add_action('wp_footer',array('Coffee','modal_view'));
}


class Coffee {
  public static function scripts(){
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'jquery_slider', plugin_dir_url( __FILE__ ).'js/nouislider.jquery.min.js', 'jquery', true );
    wp_enqueue_script( 'tiny_coffee', plugin_dir_url( __FILE__ ).'js/tiny_coffee.js', array('jquery','jquery_slider'), true );
    wp_enqueue_style( 'font_awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
    wp_enqueue_style( 'jquery_slider', plugin_dir_url( __FILE__ ).'js/nouislider.jquery.min.css');
    wp_enqueue_style( 'tiny_coffee', plugin_dir_url( __FILE__ ).'tinycoffee.css');
  }
  public static function modal_view($attr) {
    $return = '<div id="modal-container">
  <article class="modal-info modal-style-wide fade js-modal">    
    <section class="modal-content">        
      <a class="coffee_close" href="#"><i class="fa fa-times"></i><span class="hidden">'.__('Close','tinycoffee').'</span></a>        ';
    $return .= Coffee::shortcode($attr);
    $return .= '</section></article></div><div class="modal-background fade">&nbsp;</div>';
    echo $return;
  }
  public static function widget() {
	require_once dirname( __FILE__ ) . '/widget.php';
    register_widget( 'Tiny_Coffee_Widget' );
  }
  public static function tag($attr=false){
    return Coffee::shortcode($attr);
  }
  public static function shortcode($attr=false,$content=false){
    $settings = array();
    if (!$attr)
      $attr = array();
    foreach ($attr as $key => $val) {
      switch ($key){
        case 'title'  : $key = 'coffee_title'; break;
        case 'text'   : $key = 'coffee_text'; break;
        case 'icon'   : $key = 'coffee_icon'; break;
        case 'price'  : $key = 'coffee_price'; break;
        case 'for'    : $key = 'paypal_text'; break;
        case 'test'   : $key = 'paypal_testing'; break;
        case 'success': $key = 'callback_success'; break;
        case 'cancel' : $key = 'callback_cancel'; break;
      }
      $settings[$key] = $val;
    }
    if($content)
      $settings['coffee_text'] = $content;
    return Coffee::build($settings);
  }
  public static function build($settings=false){
    global $tiny_coffee_options;
    $options = $tiny_coffee_options->get();
    if (!$settings)
      $settings = array();
    foreach ($settings as $key => $val) {
      $options[$key] = $val;
    }
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
//      'no_note' => '1'
    ); 

    $paypal_url = $options['paypal_testing']?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    if (isset($options['widget']) && $options['widget']){
      $return  = "<div class=\"tiny_coffee tiny_coffee_widget\">\r\n";
    } else {
      $return  = "<div class=\"tiny_coffee\">\r\n";
      $return .= "  <header class=\"modal-header\"><h1>{$options['coffee_title']}</h1></header>\r\n";
    }
    $return .= "  <section class=\"modal-body\" data-icon=\"{$options['coffee_icon']}\" data-price=\"{$options['coffee_price']}\" data-rate=\"{$options['paypal_exchange']}\" data-currency=\"{$options['coffee_currency']}\" data-hash=\"{$options['coffee_hash']}\">\r\n";
    $return .= "    <p class=\"note\">{$options['coffee_text']}</p>\r\n";
    $return .= "    <div class=\"tiny_coffee_slider\"></div>\r\n";
    $return .= "    <div class=\"right\"><span class=\"count\"></span> <small class=\"count2\"></small></div>\r\n";
    $return .= "    <form action=\"{$paypal_url}\" method=\"post\" class=\"tiny_coffee_form\">\r\n";
    foreach ($form_data as $key => $value) {
      $return .=  "      <input type=\"hidden\" name=\"{$key}\" value=\"{$value}\"/>\r\n";
    }
    $return .= "      <button type=\"submit\"><i class=\"fa fa-shopping-cart\"></i></button>\r\n";
    $return .= "    </form>";
    $return .= "  </section>";
    $return .= "</div>";
    return $return;
  }
}
