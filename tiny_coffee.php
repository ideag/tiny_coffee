<?php 
/*
Plugin Name: tinyCoffee
Plugin URI: http://wp.tribuna.lt/tiny-coffee
Description: Ask people for coffee money
Version: 0.1
Author: Arūnas
Author URI: http://wp.tribuna.lt/
Text Domain: tiny_coffee
*/
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
  echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
  exit;
}
define('WEBTOPAY', plugin_dir_path(__FILE__ ).'webtopay/WebToPay.php');


if (isset($_REQUEST['tiny_coffee'])) {
  if (isset($_POST['tiny_webtopay'])) {
    require_once(WEBTOPAY);
    $request = WebToPay::redirectToPayment(array(
      'projectid'     => 5282,
      'sign_password' => '944c723d7a43af1a24efc1ffad9eb892',
      'orderid'       => false,
      'amount'        => $_POST['tiny_amount'],
      'currency'      => $_POST['tiny_currency'],
      'country'       => 'LT',
      'paytext'       => $_POST['tiny_text'],
//      'p_email'       => $_POST['email'],
      'payment'       => $_POST['tiny_webtopay'],
      'accepturl'     => get_bloginfo( 'url' ).'/aciu',
      'cancelurl'     => get_bloginfo( 'url' ).'',
      'callbackurl'   => get_bloginfo( 'url' ).'?webtopay_callback',
      'test'          => 0,
    ));  
  } elseif (isset($_REQUEST['tiny_paypal'])) {
//    $address = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
  $address = 'https://www.paypal.com/cgi-bin/webscr';
    $data = array(
      'business' => 'arunas@liuiza.lt',
      'cmd' => '_xclick',
      'rm' => '2',
      'amount' => round($_POST['tiny_amount']/100/3.45,2),
      'return' => get_bloginfo( 'url' ).'/aciu',
      'cancel_return' => get_bloginfo( 'url' ).'',
      'item_name' => $_POST['tiny_text'],
      'currency_code' => 'EUR',//$_POST['tiny_currency'],
      'no_shipping' => '1',
//      'no_note' => '1'
    ); 
    echo '<html><head><meta charset="utf-8"/></head><body><form id="form" action="'.$address.'" method="post">';
    foreach ($data as $key => $value) {
      echo "<input type='hidden' name='{$key}' value='{$value}'/>";
    }
    echo '</form>';
    echo '<script>document.getElementById("form").submit();</script></body></html>';
//    print_r($data);
//    $result = wp_remote_post( $address, array('body'=>$data,'sslverify'=>false));
//    print_r($result);
//    die('PAYPAL');
  } else {
    print_r($_REQUEST);
    die();
  }
} else if(isset($_REQUEST['webtopay_callback'])) {
  die('OK');
}

add_action( 'wp_head', 'tiny_coffee_verify_webtopay' );
function tiny_coffee_verify_webtopay(){
  echo "  <meta name=\"verify-webtopay\" content=\"b4796ae9288852a80fd33d051d630352\">\r\n";
}

add_shortcode( 'tiny_coffee', 'tiny_coffee_shortcode' );
function tiny_coffee_shortcode($attr, $content) {
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'jquery_slider', plugin_dir_url( __FILE__ ).'slider/js/simple-slider.min.js', 'jquery', true );
  wp_enqueue_script( 'tiny_coffee', plugin_dir_url( __FILE__ ).'js/tiny_coffee.js', 'jquery,jquery_slider', '1.1', true );
//  wp_enqueue_script( $handle, $src = false, $deps = array, $ver = false, $in_footer = false )
  wp_enqueue_style( 'jquery_slider', plugin_dir_url( __FILE__ ).'slider/css/simple-slider.css');
  $return = '<form action="?tiny_coffee" method="post" class="tiny_form">';
  $return .= "  <p>{$content}</p>";
  $return .= "  <p>
    <input type=\"text\" id=\"tiny_amount\" name=\"tiny_amount\" value=\"600\" data-slider-step=\"600\"  data-slider-snap=\"true\" data-slider-range=\"600,6000\" data-slider=\"true\"/>
    <span class=\"count\" style=\"font-size:200%;\"></span><!-- <span class=\"unit\">puodelis(-iai)</span>-->
    <small class=\"count2\"></small> <small class=\"unit2\">Lt</small>
  </p>\r\n";
  $currency = 'LTL';
  require_once(WEBTOPAY);
//  $methods = WebToPay::getPaymentMethodList(5282, $currency)
//    ->filterForAmount('600', $currency)    // filter: leave only those, which are available for this sum
//    ->setDefaultLanguage('en');         
//  $countries = $methods->getCountries();
//  foreach ($countries['lt']->getGroups() as $key => $group) {
//    if ($key!='other')
//      foreach ($group->getPaymentMethods() as $method) {
//      $m[] = $method; 
//  $return .= "<button type=\"submit\" name=\"tiny_webtopay\" value=\"{$method->getKey()}\" style=\"background-color:transparent;width:100px;margin-right:10px; border:1px solid #333;border-radius:5px;padding:5px;\"><img src=\"{$method->getLogoUrl()}\" alt=\"{$method->getTitle()}\" title=\"{$method->getTitle()}\" style=\"width:100%;\"/></button>";
//      $return .= "<input type=\"image\" name=\"tiny_webtopay\" value=\"{$method->getKey()}\" src=\"{$method->getLogoUrl()}\" alt=\"{$method->getTitle()}\" title=\"{$method->getTitle()}\" style=\"width:100px;margin-right:10px; border:1px solid;border-radius:5px;padding:5px;\"/>";
/*  $return .= "  <p class=\"include\">
    <input type=\"radio\" class=\"radio\" name=\"tiny_payment\" value=\"{$method->getKey()}\" />
    <label for=\"tiny_payment\"><img src=\"{$method->getLogoUrl()}\" class=\"wp-smiley\" alt=\"{$method->getTitle()}\" title=\"{$method->getTitle()}\"/></label>
  </p>\r\n";*/
//    }
//  }
  $return .= "<input type=\"hidden\" name=\"tiny_currency\" value=\"LTL\"/>";
  $return .= "<input type=\"hidden\" name=\"tiny_text\" value=\"Kava Arūnui\"/>";
  $return .= "<button type=\"submit\" name=\"tiny_paypal\" value=\"1\" style=\"background-color:transparent;width:100px;margin-right:10px; border:1px solid #333;border-radius:5px;padding:5px;\"><img src=\"".plugin_dir_url( __FILE__ )."img/paypal.png\" alt=\"\" title=\"\" style=\"width:100%;\"/></button>";
//  $return .= "<input type=\"image\" name=\"tiny_paypal\" value=\"1\" src=\"".plugin_dir_url( __FILE__ )."img/paypal.png\" alt=\"\" title=\"\" style=\"width:100px;margin-right:10px; border:1px solid;border-radius:5px;padding:5px;\"/>";
  //$return .= "<button type=\"submit\" name=\"gateway\" value=\"webtopay\">".__('Mokėjimai.lt','tiny_coffee')."</button>\r\n";
  $return .= '</form>';
  return $return;
}

?>