<?php 
/*
Plugin Name: tinyCoffee
Plugin URI: http://github.com/ideag/tiny_coffee
Description: Ask people for coffee money
Version: 0.1
Author: Arūnas Liuiza
Author URI: http://github.com/ideag
Text Domain: tiny_coffee
*/
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
  echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
  exit;
}

require_once(plugin_dir_path( __FILE__ ).'options.php');
$data = array(
  'page_title'        => __('tinyCoffee Options','tiny_coffee'),
  'page_description'  => false,
  'menu_title'        => __('tinyCoffee','tiny_coffee'),
  'permission'        => 'administrator',
  'menu_slug'         => 'tiny_coffee_options',
  'option_name'       => 'tiny_coffee_options',
  'plugin_path'       => 'tiny_coffee_options',
  'real_plugin_path'  => __FILE__,
  'defaults'          => array(
    'coffee_title'      => __('Buy me a cup of coffee','tiny_coffee'),
    'coffee_text'       => __('A ridiculous amount of coffee was consumed in the process of building this project. Add some fuel if you\'d like to keep me going!','tiny_coffee'),
    'coffee_icon'       => 'coffee',
    'coffee_currency'   => '€%s',
    'coffee_price'      => '2',
    'coffee_hash'       => '#coffee',
    'paypal_email'      => '',
    'paypal_currency'   => 'EUR',
    'paypal_exchange'   => 1, 
    'paypal_text'       => __('A coffee for ','tiny_coffee').get_bloginfo('title'),
    'paypal_testing'    => false,
    'callback_success'  => get_bloginfo( 'url' ),
    'callback_cancel'   => get_bloginfo( 'url' ),
    'callback_activate' => array('template_tag'=>true,'widget'=>true,'modal_view'=>true,'shortcode'=>true)
  ),
  'section'           => array(
    array( 
      'slug'              => 'coffee',
      'title'             => __('Main Settings','tiny_coffee'),
      'field'             => array(
        array(
          'slug'              => 'title',
          'title'             => __('Default title','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'text',
          'title'             => __('Default text','tiny_coffee'),
          'type'              => 'textarea'
        ),
        array(
          'slug'              => 'icon',
          'title'             => __('Default icon','tiny_coffee'),
          'type'              => 'select',
          'description'       => __('You can choose any <a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a> icon','tiny_coffee'),
          'options'           => array(
            'list'              =>array(
              "coffee"      => __('coffee','tiny_coffee'),
              "beer"        => __('beer','tiny_coffee'),
              "glass"       => __('glass','tiny_coffee'),
              "money" => __('money','tiny_coffee'),
              "music"       => __('music','tiny_coffee'),
              "search"      => __('search','tiny_coffee'),
              "envelope-o"  => __('envelope-o','tiny_coffee'),
              "heart"       => __('heart','tiny_coffee'),
              "star"        => __('star','tiny_coffee'),
              "star-o"      => __('star-o','tiny_coffee'),
              "user"        => __('user','tiny_coffee'),
              "film"        => __('film','tiny_coffee'),
              "th-large"    => __('th-large','tiny_coffee'),
              "th"          => __('th','tiny_coffee'),
              "th-list"     => __('th-list','tiny_coffee'),
              "check"       => __('check','tiny_coffee'),
              "times"       => __('times','tiny_coffee'),
              "search-plus" => __('search-plus','tiny_coffee'),
              "search-minus"=> __('search-minus','tiny_coffee'),
              "power-off"   => __('power-off','tiny_coffee'),
              "signal"      => __('signal','tiny_coffee'),
              "cog"         => __('cog','tiny_coffee'),
              "trash-o"     => __('trash-o','tiny_coffee'),
              "home"        => __('home','tiny_coffee'),
              "file-o" => __('file-o','tiny_coffee'),
              "clock-o" => __('clock-o','tiny_coffee'),
              "road" => __('road','tiny_coffee'),
              "download" => __('download','tiny_coffee'),
              "arrow-circle-o-down" => __('arrow-circle-o-down','tiny_coffee'),
              "arrow-circle-o-up" => __('arrow-circle-o-up','tiny_coffee'),
              "inbox" => __('inbox','tiny_coffee'),
              "play-circle-o" => __('play-circle-o','tiny_coffee'),
              "repeat" => __('repeat','tiny_coffee'),
              "refresh" => __('refresh','tiny_coffee'),
              "list-alt" => __('list-alt','tiny_coffee'),
              "lock" => __('lock','tiny_coffee'),
              "flag" => __('flag','tiny_coffee'),
              "headphones" => __('headphones','tiny_coffee'),
              "volume-off" => __('volume-off','tiny_coffee'),
              "volume-down" => __('volume-down','tiny_coffee'),
              "volume-up" => __('volume-up','tiny_coffee'),
              "qrcode" => __('qrcode','tiny_coffee'),
              "barcode" => __('barcode','tiny_coffee'),
              "tag" => __('tag','tiny_coffee'),
              "tags" => __('tags','tiny_coffee'),
              "book" => __('book','tiny_coffee'),
              "bookmark" => __('bookmark','tiny_coffee'),
              "print" => __('print','tiny_coffee'),
              "camera" => __('camera','tiny_coffee'),
              "font" => __('font','tiny_coffee'),
              "bold" => __('bold','tiny_coffee'),
              "italic" => __('italic','tiny_coffee'),
              "text-height" => __('text-height','tiny_coffee'),
              "text-width" => __('text-width','tiny_coffee'),
              "align-left" => __('align-left','tiny_coffee'),
              "align-center" => __('align-center','tiny_coffee'),
              "align-right" => __('align-right','tiny_coffee'),
              "align-justify" => __('align-justify','tiny_coffee'),
              "list" => __('list','tiny_coffee'),
              "outdent" => __('outdent','tiny_coffee'),
              "indent" => __('indent','tiny_coffee'),
              "video-camera" => __('video-camera','tiny_coffee'),
              "picture-o" => __('picture-o','tiny_coffee'),
              "pencil" => __('pencil','tiny_coffee'),
              "map-marker" => __('map-marker','tiny_coffee'),
              "adjust" => __('adjust','tiny_coffee'),
              "tint" => __('tint','tiny_coffee'),
              "pencil-square-o" => __('pencil-square-o','tiny_coffee'),
              "share-square-o" => __('share-square-o','tiny_coffee'),
              "check-square-o" => __('check-square-o','tiny_coffee'),
              "arrows" => __('arrows','tiny_coffee'),
              "step-backward" => __('step-backward','tiny_coffee'),
              "fast-backward" => __('fast-backward','tiny_coffee'),
              "backward" => __('backward','tiny_coffee'),
              "play" => __('play','tiny_coffee'),
              "pause" => __('pause','tiny_coffee'),
              "stop" => __('stop','tiny_coffee'),
              "forward" => __('forward','tiny_coffee'),
              "fast-forward" => __('fast-forward','tiny_coffee'),
              "step-forward" => __('step-forward','tiny_coffee'),
              "eject" => __('eject','tiny_coffee'),
              "chevron-left" => __('chevron-left','tiny_coffee'),
              "chevron-right" => __('chevron-right','tiny_coffee'),
              "plus-circle" => __('plus-circle','tiny_coffee'),
              "minus-circle" => __('minus-circle','tiny_coffee'),
              "times-circle" => __('times-circle','tiny_coffee'),
              "check-circle" => __('check-circle','tiny_coffee'),
              "question-circle" => __('question-circle','tiny_coffee'),
              "info-circle" => __('info-circle','tiny_coffee'),
              "crosshairs" => __('crosshairs','tiny_coffee'),
              "times-circle-o" => __('times-circle-o','tiny_coffee'),
              "check-circle-o" => __('check-circle-o','tiny_coffee'),
              "ban" => __('ban','tiny_coffee'),
              "arrow-left" => __('arrow-left','tiny_coffee'),
              "arrow-right" => __('arrow-right','tiny_coffee'),
              "arrow-up" => __('arrow-up','tiny_coffee'),
              "arrow-down" => __('arrow-down','tiny_coffee'),
              "share" => __('share','tiny_coffee'),
              "expand" => __('expand','tiny_coffee'),
              "compress" => __('compress','tiny_coffee'),
              "plus" => __('plus','tiny_coffee'),
              "minus" => __('minus','tiny_coffee'),
              "asterisk" => __('asterisk','tiny_coffee'),
              "exclamation-circle" => __('exclamation-circle','tiny_coffee'),
              "gift" => __('gift','tiny_coffee'),
              "leaf" => __('leaf','tiny_coffee'),
              "fire" => __('fire','tiny_coffee'),
              "eye" => __('eye','tiny_coffee'),
              "eye-slash" => __('eye-slash','tiny_coffee'),
              "exclamation-triangle" => __('exclamation-triangle','tiny_coffee'),
              "plane" => __('plane','tiny_coffee'),
              "calendar" => __('calendar','tiny_coffee'),
              "random" => __('random','tiny_coffee'),
              "comment" => __('comment','tiny_coffee'),
              "magnet" => __('magnet','tiny_coffee'),
              "chevron-up" => __('chevron-up','tiny_coffee'),
              "chevron-down" => __('chevron-down','tiny_coffee'),
              "retweet" => __('retweet','tiny_coffee'),
              "shopping-cart" => __('shopping-cart','tiny_coffee'),
              "folder" => __('folder','tiny_coffee'),
              "folder-open" => __('folder-open','tiny_coffee'),
              "arrows-v" => __('arrows-v','tiny_coffee'),
              "arrows-h" => __('arrows-h','tiny_coffee'),
              "bar-chart-o" => __('bar-chart-o','tiny_coffee'),
              "twitter-square" => __('twitter-square','tiny_coffee'),
              "facebook-square" => __('facebook-square','tiny_coffee'),
              "camera-retro" => __('camera-retro','tiny_coffee'),
              "key" => __('key','tiny_coffee'),
              "cogs" => __('cogs','tiny_coffee'),
              "comments" => __('comments','tiny_coffee'),
              "thumbs-o-up" => __('thumbs-o-up','tiny_coffee'),
              "thumbs-o-down" => __('thumbs-o-down','tiny_coffee'),
              "star-half" => __('star-half','tiny_coffee'),
              "heart-o" => __('heart-o','tiny_coffee'),
              "sign-out" => __('sign-out','tiny_coffee'),
              "linkedin-square" => __('linkedin-square','tiny_coffee'),
              "thumb-tack" => __('thumb-tack','tiny_coffee'),
              "external-link" => __('external-link','tiny_coffee'),
              "sign-in" => __('sign-in','tiny_coffee'),
              "trophy" => __('trophy','tiny_coffee'),
              "github-square" => __('github-square','tiny_coffee'),
              "upload" => __('upload','tiny_coffee'),
              "lemon-o" => __('lemon-o','tiny_coffee'),
              "phone" => __('phone','tiny_coffee'),
              "square-o" => __('square-o','tiny_coffee'),
              "bookmark-o" => __('bookmark-o','tiny_coffee'),
              "phone-square" => __('phone-square','tiny_coffee'),
              "twitter" => __('twitter','tiny_coffee'),
              "facebook" => __('facebook','tiny_coffee'),
              "github" => __('github','tiny_coffee'),
              "unlock" => __('unlock','tiny_coffee'),
              "credit-card" => __('credit-card','tiny_coffee'),
              "rss" => __('rss','tiny_coffee'),
              "hdd-o" => __('hdd-o','tiny_coffee'),
              "bullhorn" => __('bullhorn','tiny_coffee'),
              "bell" => __('bell','tiny_coffee'),
              "certificate" => __('certificate','tiny_coffee'),
              "hand-o-right" => __('hand-o-right','tiny_coffee'),
              "hand-o-left" => __('hand-o-left','tiny_coffee'),
              "hand-o-up" => __('hand-o-up','tiny_coffee'),
              "hand-o-down" => __('hand-o-down','tiny_coffee'),
              "arrow-circle-left" => __('arrow-circle-left','tiny_coffee'),
              "arrow-circle-right" => __('arrow-circle-right','tiny_coffee'),
              "arrow-circle-up" => __('arrow-circle-up','tiny_coffee'),
              "arrow-circle-down" => __('arrow-circle-down','tiny_coffee'),
              "globe" => __('globe','tiny_coffee'),
              "wrench" => __('wrench','tiny_coffee'),
              "tasks" => __('tasks','tiny_coffee'),
              "filter" => __('filter','tiny_coffee'),
              "briefcase" => __('briefcase','tiny_coffee'),
              "arrows-alt" => __('arrows-alt','tiny_coffee'),
              "users" => __('users','tiny_coffee'),
              "link" => __('link','tiny_coffee'),
              "cloud" => __('cloud','tiny_coffee'),
              "flask" => __('flask','tiny_coffee'),
              "scissors" => __('scissors','tiny_coffee'),
              "files-o" => __('files-o','tiny_coffee'),
              "paperclip" => __('paperclip','tiny_coffee'),
              "floppy-o" => __('floppy-o','tiny_coffee'),
              "square" => __('square','tiny_coffee'),
              "bars" => __('bars','tiny_coffee'),
              "list-ul" => __('list-ul','tiny_coffee'),
              "list-ol" => __('list-ol','tiny_coffee'),
              "strikethrough" => __('strikethrough','tiny_coffee'),
              "underline" => __('underline','tiny_coffee'),
              "table" => __('table','tiny_coffee'),
              "magic" => __('magic','tiny_coffee'),
              "truck" => __('truck','tiny_coffee'),
              "pinterest" => __('pinterest','tiny_coffee'),
              "pinterest-square" => __('pinterest-square','tiny_coffee'),
              "google-plus-square" => __('google-plus-square','tiny_coffee'),
              "google-plus" => __('google-plus','tiny_coffee'),
              "caret-down" => __('caret-down','tiny_coffee'),
              "caret-up" => __('caret-up','tiny_coffee'),
              "caret-left" => __('caret-left','tiny_coffee'),
              "caret-right" => __('caret-right','tiny_coffee'),
              "columns" => __('columns','tiny_coffee'),
              "sort" => __('sort','tiny_coffee'),
              "sort-asc" => __('sort-asc','tiny_coffee'),
              "sort-desc" => __('sort-desc','tiny_coffee'),
              "envelope" => __('envelope','tiny_coffee'),
              "linkedin" => __('linkedin','tiny_coffee'),
              "undo" => __('undo','tiny_coffee'),
              "gavel" => __('gavel','tiny_coffee'),
              "tachometer" => __('tachometer','tiny_coffee'),
              "comment-o" => __('comment-o','tiny_coffee'),
              "comments-o" => __('comments-o','tiny_coffee'),
              "bolt" => __('bolt','tiny_coffee'),
              "sitemap" => __('sitemap','tiny_coffee'),
              "umbrella" => __('umbrella','tiny_coffee'),
              "clipboard" => __('clipboard','tiny_coffee'),
              "lightbulb-o" => __('lightbulb-o','tiny_coffee'),
              "exchange" => __('exchange','tiny_coffee'),
              "cloud-download" => __('cloud-download','tiny_coffee'),
              "cloud-upload" => __('cloud-upload','tiny_coffee'),
              "user-md" => __('user-md','tiny_coffee'),
              "stethoscope" => __('stethoscope','tiny_coffee'),
              "suitcase" => __('suitcase','tiny_coffee'),
              "bell-o" => __('bell-o','tiny_coffee'),
              "cutlery" => __('cutlery','tiny_coffee'),
              "file-text-o" => __('file-text-o','tiny_coffee'),
              "building-o" => __('building-o','tiny_coffee'),
              "hospital-o" => __('hospital-o','tiny_coffee'),
              "ambulance" => __('ambulance','tiny_coffee'),
              "medkit" => __('medkit','tiny_coffee'),
              "fighter-jet" => __('fighter-jet','tiny_coffee'),
              "h-square" => __('h-square','tiny_coffee'),
              "plus-square" => __('plus-square','tiny_coffee'),
              "angle-double-left" => __('angle-double-left','tiny_coffee'),
              "angle-double-right" => __('angle-double-right','tiny_coffee'),
              "angle-double-up" => __('angle-double-up','tiny_coffee'),
              "angle-double-down" => __('angle-double-down','tiny_coffee'),
              "angle-left" => __('angle-left','tiny_coffee'),
              "angle-right" => __('angle-right','tiny_coffee'),
              "angle-up" => __('angle-up','tiny_coffee'),
              "angle-down" => __('angle-down','tiny_coffee'),
              "desktop" => __('desktop','tiny_coffee'),
              "laptop" => __('laptop','tiny_coffee'),
              "tablet" => __('tablet','tiny_coffee'),
              "mobile" => __('mobile','tiny_coffee'),
              "circle-o" => __('circle-o','tiny_coffee'),
              "quote-left" => __('quote-left','tiny_coffee'),
              "quote-right" => __('quote-right','tiny_coffee'),
              "spinner" => __('spinner','tiny_coffee'),
              "circle" => __('circle','tiny_coffee'),
              "reply" => __('reply','tiny_coffee'),
              "github-alt" => __('github-alt','tiny_coffee'),
              "folder-o" => __('folder-o','tiny_coffee'),
              "folder-open-o" => __('folder-open-o','tiny_coffee'),
              "smile-o" => __('smile-o','tiny_coffee'),
              "frown-o" => __('frown-o','tiny_coffee'),
              "meh-o" => __('meh-o','tiny_coffee'),
              "gamepad" => __('gamepad','tiny_coffee'),
              "keyboard-o" => __('keyboard-o','tiny_coffee'),
              "flag-o" => __('flag-o','tiny_coffee'),
              "flag-checkered" => __('flag-checkered','tiny_coffee'),
              "terminal" => __('terminal','tiny_coffee'),
              "code" => __('code','tiny_coffee'),
              "reply-all" => __('reply-all','tiny_coffee'),
              "mail-reply-all" => __('mail-reply-all','tiny_coffee'),
              "star-half-o" => __('star-half-o','tiny_coffee'),
              "location-arrow" => __('location-arrow','tiny_coffee'),
              "crop" => __('crop','tiny_coffee'),
              "code-fork" => __('code-fork','tiny_coffee'),
              "chain-broken" => __('chain-broken','tiny_coffee'),
              "question" => __('question','tiny_coffee'),
              "info" => __('info','tiny_coffee'),
              "exclamation" => __('exclamation','tiny_coffee'),
              "superscript" => __('superscript','tiny_coffee'),
              "subscript" => __('subscript','tiny_coffee'),
              "eraser" => __('eraser','tiny_coffee'),
              "puzzle-piece" => __('puzzle-piece','tiny_coffee'),
              "microphone" => __('microphone','tiny_coffee'),
              "microphone-slash" => __('microphone-slash','tiny_coffee'),
              "shield" => __('shield','tiny_coffee'),
              "calendar-o" => __('calendar-o','tiny_coffee'),
              "fire-extinguisher" => __('fire-extinguisher','tiny_coffee'),
              "rocket" => __('rocket','tiny_coffee'),
              "maxcdn" => __('maxcdn','tiny_coffee'),
              "chevron-circle-left" => __('chevron-circle-left','tiny_coffee'),
              "chevron-circle-right" => __('chevron-circle-right','tiny_coffee'),
              "chevron-circle-up" => __('chevron-circle-up','tiny_coffee'),
              "chevron-circle-down" => __('chevron-circle-down','tiny_coffee'),
              "html5" => __('html5','tiny_coffee'),
              "css3" => __('css3','tiny_coffee'),
              "anchor" => __('anchor','tiny_coffee'),
              "unlock-alt" => __('unlock-alt','tiny_coffee'),
              "bullseye" => __('bullseye','tiny_coffee'),
              "ellipsis-h" => __('ellipsis-h','tiny_coffee'),
              "ellipsis-v" => __('ellipsis-v','tiny_coffee'),
              "rss-square" => __('rss-square','tiny_coffee'),
              "play-circle" => __('play-circle','tiny_coffee'),
              "ticket" => __('ticket','tiny_coffee'),
              "minus-square" => __('minus-square','tiny_coffee'),
              "minus-square-o" => __('minus-square-o','tiny_coffee'),
              "level-up" => __('level-up','tiny_coffee'),
              "level-down" => __('level-down','tiny_coffee'),
              "check-square" => __('check-square','tiny_coffee'),
              "pencil-square" => __('pencil-square','tiny_coffee'),
              "external-link-square" => __('external-link-square','tiny_coffee'),
              "share-square" => __('share-square','tiny_coffee'),
              "compass" => __('compass','tiny_coffee'),
              "caret-square-o-down" => __('caret-square-o-down','tiny_coffee'),
              "caret-square-o-up" => __('caret-square-o-up','tiny_coffee'),
              "caret-square-o-right" => __('caret-square-o-right','tiny_coffee'),
              "eur" => __('eur','tiny_coffee'),
              "gbp" => __('gbp','tiny_coffee'),
              "usd" => __('usd','tiny_coffee'),
              "inr" => __('inr','tiny_coffee'),
              "jpy" => __('jpy','tiny_coffee'),
              "rub" => __('rub','tiny_coffee'),
              "krw" => __('krw','tiny_coffee'),
              "btc" => __('btc','tiny_coffee'),
              "file" => __('file','tiny_coffee'),
              "file-text" => __('file-text','tiny_coffee'),
              "sort-alpha-asc" => __('sort-alpha-asc','tiny_coffee'),
              "sort-alpha-desc" => __('sort-alpha-desc','tiny_coffee'),
              "sort-amount-asc" => __('sort-amount-asc','tiny_coffee'),
              "sort-amount-desc" => __('sort-amount-desc','tiny_coffee'),
              "sort-numeric-asc" => __('sort-numeric-asc','tiny_coffee'),
              "sort-numeric-desc" => __('sort-numeric-desc','tiny_coffee'),
              "thumbs-up" => __('thumbs-up','tiny_coffee'),
              "thumbs-down" => __('thumbs-down','tiny_coffee'),
              "youtube-square" => __('youtube-square','tiny_coffee'),
              "youtube" => __('youtube','tiny_coffee'),
              "xing" => __('xing','tiny_coffee'),
              "xing-square" => __('xing-square','tiny_coffee'),
              "youtube-play" => __('youtube-play','tiny_coffee'),
              "dropbox" => __('dropbox','tiny_coffee'),
              "stack-overflow" => __('stack-overflow','tiny_coffee'),
              "instagram" => __('instagram','tiny_coffee'),
              "flickr" => __('flickr','tiny_coffee'),
              "adn" => __('adn','tiny_coffee'),
              "bitbucket" => __('bitbucket','tiny_coffee'),
              "bitbucket-square" => __('bitbucket-square','tiny_coffee'),
              "tumblr" => __('tumblr','tiny_coffee'),
              "tumblr-square" => __('tumblr-square','tiny_coffee'),
              "long-arrow-down" => __('long-arrow-down','tiny_coffee'),
              "long-arrow-up" => __('long-arrow-up','tiny_coffee'),
              "long-arrow-left" => __('long-arrow-left','tiny_coffee'),
              "long-arrow-right" => __('long-arrow-right','tiny_coffee'),
              "apple" => __('apple','tiny_coffee'),
              "windows" => __('windows','tiny_coffee'),
              "android" => __('android','tiny_coffee'),
              "linux" => __('linux','tiny_coffee'),
              "dribbble" => __('dribbble','tiny_coffee'),
              "skype" => __('skype','tiny_coffee'),
              "foursquare" => __('foursquare','tiny_coffee'),
              "trello" => __('trello','tiny_coffee'),
              "female" => __('female','tiny_coffee'),
              "male" => __('male','tiny_coffee'),
              "gittip" => __('gittip','tiny_coffee'),
              "sun-o" => __('sun-o','tiny_coffee'),
              "moon-o" => __('moon-o','tiny_coffee'),
              "archive" => __('archive','tiny_coffee'),
              "bug" => __('bug','tiny_coffee'),
              "vk" => __('vk','tiny_coffee'),
              "weibo" => __('weibo','tiny_coffee'),
              "renren" => __('renren','tiny_coffee'),
              "pagelines" => __('pagelines','tiny_coffee'),
              "stack-exchange" => __('stack-exchange','tiny_coffee'),
              "arrow-circle-o-right" => __('arrow-circle-o-right','tiny_coffee'),
              "arrow-circle-o-left" => __('arrow-circle-o-left','tiny_coffee'),
              "caret-square-o-left" => __('caret-square-o-left','tiny_coffee'),
              "dot-circle-o" => __('dot-circle-o','tiny_coffee'),
              "wheelchair" => __('wheelchair','tiny_coffee'),
              "vimeo-square" => __('vimeo-square','tiny_coffee'),
              "try" => __('try','tiny_coffee'),
              "plus-square-o" => __('plus-square-o','tiny_coffee'),
            )
          )
        ),
        array(
          'slug'              => 'hash',
          'title'             => __('Hash','tiny_coffee'),
          'type'              => 'text',
        ),
        array(
          'slug'              => 'currency',
          'title'             => __('Currency template','tiny_coffee'),
          'type'              => 'text',
        ),
        array(
          'slug'              => 'price',
          'title'             => __('Coffee price','tiny_coffee'),
          'type'              => 'text',
          'description'       => __('How much is a single cup of your favorite coffee?','tiny_coffee'),
        ),
      )
    ),
    array( 
      'slug'              => 'paypal',
      'title'             => __('Paypal Settings','tiny_coffee'),
      'field'             => array(
        array(
          'slug'              => 'email',
          'title'             => __('Paypal username','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'currency',
          'title'             => __('Paypal currency','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'exchange',
          'title'             => __('Exchange rate','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'text',
          'title'             => __('Payment text','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'testing',
          'title'             => __('Sandbox mode','tiny_coffee'),
          'type'              => 'checkbox'
        ),
      )
    ),
    array( 
      'slug'              => 'callback',
      'title'             => __('Callback Settings','tiny_coffee'),
      'field'             => array(
        array(
          'slug'              => 'success',
          'title'             => __('Success callback','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'cancel',
          'title'             => __('Cancel callback','tiny_coffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'activate',
          'title'             => __('Activate','tiny_coffee'),
          'type'              => 'checkbox_list',
          'options'           => array(
            'list'              => array(
              'template_tag'      => __('Template tag','tiny_coffee'),
              'shortcode'         => __('Shortcode','tiny_coffee'),
              'modal_view'        => __('Modal dialog','tiny_coffee'),
              'widget'            => __('Widget','tiny_coffee'),
            )
          )
        )
      )
    )
  )
);
$tiny_coffee_options = new tiny_options($data);
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

class Coffee_widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'coffee_widget', 
      __('Coffee Widget', 'tiny_coffee'), 
      array( 'description' => __( 'Ask for coffee in your sidebar', 'tiny_coffee' ) ) 
    );
  }
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    $instance['widget'] = true;
    foreach($instance as $key=>$val) {
      if(!$val) 
        unset($instance[$key]);
    }
    echo Coffee::tag($instance);
    echo $args['after_widget'];
  }
  public function form( $instance ) {
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','tiny_coffee' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:','tiny_coffee' ); ?></label> 
      <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $title ); ?></textarea>
    </p>
    <?php 
  }
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
    return $instance;
  }
} // Class wpb_widget ends here

class Coffee {
  public static function scripts(){
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'jquery_slider', plugin_dir_url( __FILE__ ).'js/nouislider.jquery.min.js', 'jquery', true );
    wp_enqueue_script( 'tiny_coffee', plugin_dir_url( __FILE__ ).'js/tiny_coffee.js', array('jquery','jquery_slider'), true );
    wp_enqueue_style( 'font_awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
    wp_enqueue_style( 'jquery_slider', plugin_dir_url( __FILE__ ).'js/nouislider.jquery.min.css');
    wp_enqueue_style( 'tiny_coffee', plugin_dir_url( __FILE__ ).'tiny_coffee.css');
  }
  public static function modal_view($attr) {
    $return = '<div id="modal-container">
  <article class="modal-info modal-style-wide fade js-modal">    
    <section class="modal-content">        
      <a class="coffee_close" href="#"><i class="fa fa-times"></i><span class="hidden">'.__('Close','tiny_coffee').'</span></a>        ';
    $return .= Coffee::shortcode($attr);
    $return .= '</section></article></div><div class="modal-background fade">&nbsp;</div>';
    echo $return;
  }
  public static function widget() {
    register_widget( 'coffee_widget' );
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

?>