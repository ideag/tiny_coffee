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
$data = array(
  'page_title'        => __('tinyCoffee Options','tinycoffee'),
  'page_description'  => false,
  'menu_title'        => __('tinyCoffee','tinycoffee'),
  'permission'        => 'administrator',
  'menu_slug'         => 'tiny_coffee_options',
  'option_name'       => 'tiny_coffee_options',
  'plugin_path'       => 'tiny_coffee_options',
  'real_plugin_path'  => __FILE__,
  'defaults'          => array(
    'coffee_title'      => __('Buy me a cup of coffee','tinycoffee'),
    'coffee_text'       => __('A ridiculous amount of coffee was consumed in the process of building this project. Add some fuel if you\'d like to keep me going!','tinycoffee'),
    'coffee_icon'       => 'coffee',
    'coffee_currency'   => '€%s',
    'coffee_price'      => '2',
    'coffee_hash'       => '#coffee',
    'paypal_email'      => '',
    'paypal_currency'   => 'EUR',
    'paypal_exchange'   => 1, 
    'paypal_text'       => __('A coffee for ','tinycoffee').get_bloginfo('title'),
    'paypal_testing'    => false,
    'callback_success'  => get_bloginfo( 'url' ),
    'callback_cancel'   => get_bloginfo( 'url' ),
    'callback_activate' => array('template_tag'=>true,'widget'=>true,'modal_view'=>true,'shortcode'=>true)
  ),
  'section'           => array(
    array( 
      'slug'              => 'coffee',
      'title'             => __('Main Settings','tinycoffee'),
      'field'             => array(
        array(
          'slug'              => 'title',
          'title'             => __('Default title','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'text',
          'title'             => __('Default text','tinycoffee'),
          'type'              => 'textarea'
        ),
        array(
          'slug'              => 'icon',
          'title'             => __('Default icon','tinycoffee'),
          'type'              => 'select',
          'description'       => __('You can choose any <a href="http://fontawesome.io/icons/" target="_blank">FontAwesome</a> icon','tinycoffee'),
          'options'           => array(
            'list'              =>array(
              "coffee"      => __('coffee','tinycoffee'),
              "beer"        => __('beer','tinycoffee'),
              "glass"       => __('glass','tinycoffee'),
              "money" => __('money','tinycoffee'),
              "music"       => __('music','tinycoffee'),
              "search"      => __('search','tinycoffee'),
              "envelope-o"  => __('envelope-o','tinycoffee'),
              "heart"       => __('heart','tinycoffee'),
              "star"        => __('star','tinycoffee'),
              "star-o"      => __('star-o','tinycoffee'),
              "user"        => __('user','tinycoffee'),
              "film"        => __('film','tinycoffee'),
              "th-large"    => __('th-large','tinycoffee'),
              "th"          => __('th','tinycoffee'),
              "th-list"     => __('th-list','tinycoffee'),
              "check"       => __('check','tinycoffee'),
              "times"       => __('times','tinycoffee'),
              "search-plus" => __('search-plus','tinycoffee'),
              "search-minus"=> __('search-minus','tinycoffee'),
              "power-off"   => __('power-off','tinycoffee'),
              "signal"      => __('signal','tinycoffee'),
              "cog"         => __('cog','tinycoffee'),
              "trash-o"     => __('trash-o','tinycoffee'),
              "home"        => __('home','tinycoffee'),
              "file-o" => __('file-o','tinycoffee'),
              "clock-o" => __('clock-o','tinycoffee'),
              "road" => __('road','tinycoffee'),
              "download" => __('download','tinycoffee'),
              "arrow-circle-o-down" => __('arrow-circle-o-down','tinycoffee'),
              "arrow-circle-o-up" => __('arrow-circle-o-up','tinycoffee'),
              "inbox" => __('inbox','tinycoffee'),
              "play-circle-o" => __('play-circle-o','tinycoffee'),
              "repeat" => __('repeat','tinycoffee'),
              "refresh" => __('refresh','tinycoffee'),
              "list-alt" => __('list-alt','tinycoffee'),
              "lock" => __('lock','tinycoffee'),
              "flag" => __('flag','tinycoffee'),
              "headphones" => __('headphones','tinycoffee'),
              "volume-off" => __('volume-off','tinycoffee'),
              "volume-down" => __('volume-down','tinycoffee'),
              "volume-up" => __('volume-up','tinycoffee'),
              "qrcode" => __('qrcode','tinycoffee'),
              "barcode" => __('barcode','tinycoffee'),
              "tag" => __('tag','tinycoffee'),
              "tags" => __('tags','tinycoffee'),
              "book" => __('book','tinycoffee'),
              "bookmark" => __('bookmark','tinycoffee'),
              "print" => __('print','tinycoffee'),
              "camera" => __('camera','tinycoffee'),
              "font" => __('font','tinycoffee'),
              "bold" => __('bold','tinycoffee'),
              "italic" => __('italic','tinycoffee'),
              "text-height" => __('text-height','tinycoffee'),
              "text-width" => __('text-width','tinycoffee'),
              "align-left" => __('align-left','tinycoffee'),
              "align-center" => __('align-center','tinycoffee'),
              "align-right" => __('align-right','tinycoffee'),
              "align-justify" => __('align-justify','tinycoffee'),
              "list" => __('list','tinycoffee'),
              "outdent" => __('outdent','tinycoffee'),
              "indent" => __('indent','tinycoffee'),
              "video-camera" => __('video-camera','tinycoffee'),
              "picture-o" => __('picture-o','tinycoffee'),
              "pencil" => __('pencil','tinycoffee'),
              "map-marker" => __('map-marker','tinycoffee'),
              "adjust" => __('adjust','tinycoffee'),
              "tint" => __('tint','tinycoffee'),
              "pencil-square-o" => __('pencil-square-o','tinycoffee'),
              "share-square-o" => __('share-square-o','tinycoffee'),
              "check-square-o" => __('check-square-o','tinycoffee'),
              "arrows" => __('arrows','tinycoffee'),
              "step-backward" => __('step-backward','tinycoffee'),
              "fast-backward" => __('fast-backward','tinycoffee'),
              "backward" => __('backward','tinycoffee'),
              "play" => __('play','tinycoffee'),
              "pause" => __('pause','tinycoffee'),
              "stop" => __('stop','tinycoffee'),
              "forward" => __('forward','tinycoffee'),
              "fast-forward" => __('fast-forward','tinycoffee'),
              "step-forward" => __('step-forward','tinycoffee'),
              "eject" => __('eject','tinycoffee'),
              "chevron-left" => __('chevron-left','tinycoffee'),
              "chevron-right" => __('chevron-right','tinycoffee'),
              "plus-circle" => __('plus-circle','tinycoffee'),
              "minus-circle" => __('minus-circle','tinycoffee'),
              "times-circle" => __('times-circle','tinycoffee'),
              "check-circle" => __('check-circle','tinycoffee'),
              "question-circle" => __('question-circle','tinycoffee'),
              "info-circle" => __('info-circle','tinycoffee'),
              "crosshairs" => __('crosshairs','tinycoffee'),
              "times-circle-o" => __('times-circle-o','tinycoffee'),
              "check-circle-o" => __('check-circle-o','tinycoffee'),
              "ban" => __('ban','tinycoffee'),
              "arrow-left" => __('arrow-left','tinycoffee'),
              "arrow-right" => __('arrow-right','tinycoffee'),
              "arrow-up" => __('arrow-up','tinycoffee'),
              "arrow-down" => __('arrow-down','tinycoffee'),
              "share" => __('share','tinycoffee'),
              "expand" => __('expand','tinycoffee'),
              "compress" => __('compress','tinycoffee'),
              "plus" => __('plus','tinycoffee'),
              "minus" => __('minus','tinycoffee'),
              "asterisk" => __('asterisk','tinycoffee'),
              "exclamation-circle" => __('exclamation-circle','tinycoffee'),
              "gift" => __('gift','tinycoffee'),
              "leaf" => __('leaf','tinycoffee'),
              "fire" => __('fire','tinycoffee'),
              "eye" => __('eye','tinycoffee'),
              "eye-slash" => __('eye-slash','tinycoffee'),
              "exclamation-triangle" => __('exclamation-triangle','tinycoffee'),
              "plane" => __('plane','tinycoffee'),
              "calendar" => __('calendar','tinycoffee'),
              "random" => __('random','tinycoffee'),
              "comment" => __('comment','tinycoffee'),
              "magnet" => __('magnet','tinycoffee'),
              "chevron-up" => __('chevron-up','tinycoffee'),
              "chevron-down" => __('chevron-down','tinycoffee'),
              "retweet" => __('retweet','tinycoffee'),
              "shopping-cart" => __('shopping-cart','tinycoffee'),
              "folder" => __('folder','tinycoffee'),
              "folder-open" => __('folder-open','tinycoffee'),
              "arrows-v" => __('arrows-v','tinycoffee'),
              "arrows-h" => __('arrows-h','tinycoffee'),
              "bar-chart-o" => __('bar-chart-o','tinycoffee'),
              "twitter-square" => __('twitter-square','tinycoffee'),
              "facebook-square" => __('facebook-square','tinycoffee'),
              "camera-retro" => __('camera-retro','tinycoffee'),
              "key" => __('key','tinycoffee'),
              "cogs" => __('cogs','tinycoffee'),
              "comments" => __('comments','tinycoffee'),
              "thumbs-o-up" => __('thumbs-o-up','tinycoffee'),
              "thumbs-o-down" => __('thumbs-o-down','tinycoffee'),
              "star-half" => __('star-half','tinycoffee'),
              "heart-o" => __('heart-o','tinycoffee'),
              "sign-out" => __('sign-out','tinycoffee'),
              "linkedin-square" => __('linkedin-square','tinycoffee'),
              "thumb-tack" => __('thumb-tack','tinycoffee'),
              "external-link" => __('external-link','tinycoffee'),
              "sign-in" => __('sign-in','tinycoffee'),
              "trophy" => __('trophy','tinycoffee'),
              "github-square" => __('github-square','tinycoffee'),
              "upload" => __('upload','tinycoffee'),
              "lemon-o" => __('lemon-o','tinycoffee'),
              "phone" => __('phone','tinycoffee'),
              "square-o" => __('square-o','tinycoffee'),
              "bookmark-o" => __('bookmark-o','tinycoffee'),
              "phone-square" => __('phone-square','tinycoffee'),
              "twitter" => __('twitter','tinycoffee'),
              "facebook" => __('facebook','tinycoffee'),
              "github" => __('github','tinycoffee'),
              "unlock" => __('unlock','tinycoffee'),
              "credit-card" => __('credit-card','tinycoffee'),
              "rss" => __('rss','tinycoffee'),
              "hdd-o" => __('hdd-o','tinycoffee'),
              "bullhorn" => __('bullhorn','tinycoffee'),
              "bell" => __('bell','tinycoffee'),
              "certificate" => __('certificate','tinycoffee'),
              "hand-o-right" => __('hand-o-right','tinycoffee'),
              "hand-o-left" => __('hand-o-left','tinycoffee'),
              "hand-o-up" => __('hand-o-up','tinycoffee'),
              "hand-o-down" => __('hand-o-down','tinycoffee'),
              "arrow-circle-left" => __('arrow-circle-left','tinycoffee'),
              "arrow-circle-right" => __('arrow-circle-right','tinycoffee'),
              "arrow-circle-up" => __('arrow-circle-up','tinycoffee'),
              "arrow-circle-down" => __('arrow-circle-down','tinycoffee'),
              "globe" => __('globe','tinycoffee'),
              "wrench" => __('wrench','tinycoffee'),
              "tasks" => __('tasks','tinycoffee'),
              "filter" => __('filter','tinycoffee'),
              "briefcase" => __('briefcase','tinycoffee'),
              "arrows-alt" => __('arrows-alt','tinycoffee'),
              "users" => __('users','tinycoffee'),
              "link" => __('link','tinycoffee'),
              "cloud" => __('cloud','tinycoffee'),
              "flask" => __('flask','tinycoffee'),
              "scissors" => __('scissors','tinycoffee'),
              "files-o" => __('files-o','tinycoffee'),
              "paperclip" => __('paperclip','tinycoffee'),
              "floppy-o" => __('floppy-o','tinycoffee'),
              "square" => __('square','tinycoffee'),
              "bars" => __('bars','tinycoffee'),
              "list-ul" => __('list-ul','tinycoffee'),
              "list-ol" => __('list-ol','tinycoffee'),
              "strikethrough" => __('strikethrough','tinycoffee'),
              "underline" => __('underline','tinycoffee'),
              "table" => __('table','tinycoffee'),
              "magic" => __('magic','tinycoffee'),
              "truck" => __('truck','tinycoffee'),
              "pinterest" => __('pinterest','tinycoffee'),
              "pinterest-square" => __('pinterest-square','tinycoffee'),
              "google-plus-square" => __('google-plus-square','tinycoffee'),
              "google-plus" => __('google-plus','tinycoffee'),
              "caret-down" => __('caret-down','tinycoffee'),
              "caret-up" => __('caret-up','tinycoffee'),
              "caret-left" => __('caret-left','tinycoffee'),
              "caret-right" => __('caret-right','tinycoffee'),
              "columns" => __('columns','tinycoffee'),
              "sort" => __('sort','tinycoffee'),
              "sort-asc" => __('sort-asc','tinycoffee'),
              "sort-desc" => __('sort-desc','tinycoffee'),
              "envelope" => __('envelope','tinycoffee'),
              "linkedin" => __('linkedin','tinycoffee'),
              "undo" => __('undo','tinycoffee'),
              "gavel" => __('gavel','tinycoffee'),
              "tachometer" => __('tachometer','tinycoffee'),
              "comment-o" => __('comment-o','tinycoffee'),
              "comments-o" => __('comments-o','tinycoffee'),
              "bolt" => __('bolt','tinycoffee'),
              "sitemap" => __('sitemap','tinycoffee'),
              "umbrella" => __('umbrella','tinycoffee'),
              "clipboard" => __('clipboard','tinycoffee'),
              "lightbulb-o" => __('lightbulb-o','tinycoffee'),
              "exchange" => __('exchange','tinycoffee'),
              "cloud-download" => __('cloud-download','tinycoffee'),
              "cloud-upload" => __('cloud-upload','tinycoffee'),
              "user-md" => __('user-md','tinycoffee'),
              "stethoscope" => __('stethoscope','tinycoffee'),
              "suitcase" => __('suitcase','tinycoffee'),
              "bell-o" => __('bell-o','tinycoffee'),
              "cutlery" => __('cutlery','tinycoffee'),
              "file-text-o" => __('file-text-o','tinycoffee'),
              "building-o" => __('building-o','tinycoffee'),
              "hospital-o" => __('hospital-o','tinycoffee'),
              "ambulance" => __('ambulance','tinycoffee'),
              "medkit" => __('medkit','tinycoffee'),
              "fighter-jet" => __('fighter-jet','tinycoffee'),
              "h-square" => __('h-square','tinycoffee'),
              "plus-square" => __('plus-square','tinycoffee'),
              "angle-double-left" => __('angle-double-left','tinycoffee'),
              "angle-double-right" => __('angle-double-right','tinycoffee'),
              "angle-double-up" => __('angle-double-up','tinycoffee'),
              "angle-double-down" => __('angle-double-down','tinycoffee'),
              "angle-left" => __('angle-left','tinycoffee'),
              "angle-right" => __('angle-right','tinycoffee'),
              "angle-up" => __('angle-up','tinycoffee'),
              "angle-down" => __('angle-down','tinycoffee'),
              "desktop" => __('desktop','tinycoffee'),
              "laptop" => __('laptop','tinycoffee'),
              "tablet" => __('tablet','tinycoffee'),
              "mobile" => __('mobile','tinycoffee'),
              "circle-o" => __('circle-o','tinycoffee'),
              "quote-left" => __('quote-left','tinycoffee'),
              "quote-right" => __('quote-right','tinycoffee'),
              "spinner" => __('spinner','tinycoffee'),
              "circle" => __('circle','tinycoffee'),
              "reply" => __('reply','tinycoffee'),
              "github-alt" => __('github-alt','tinycoffee'),
              "folder-o" => __('folder-o','tinycoffee'),
              "folder-open-o" => __('folder-open-o','tinycoffee'),
              "smile-o" => __('smile-o','tinycoffee'),
              "frown-o" => __('frown-o','tinycoffee'),
              "meh-o" => __('meh-o','tinycoffee'),
              "gamepad" => __('gamepad','tinycoffee'),
              "keyboard-o" => __('keyboard-o','tinycoffee'),
              "flag-o" => __('flag-o','tinycoffee'),
              "flag-checkered" => __('flag-checkered','tinycoffee'),
              "terminal" => __('terminal','tinycoffee'),
              "code" => __('code','tinycoffee'),
              "reply-all" => __('reply-all','tinycoffee'),
              "mail-reply-all" => __('mail-reply-all','tinycoffee'),
              "star-half-o" => __('star-half-o','tinycoffee'),
              "location-arrow" => __('location-arrow','tinycoffee'),
              "crop" => __('crop','tinycoffee'),
              "code-fork" => __('code-fork','tinycoffee'),
              "chain-broken" => __('chain-broken','tinycoffee'),
              "question" => __('question','tinycoffee'),
              "info" => __('info','tinycoffee'),
              "exclamation" => __('exclamation','tinycoffee'),
              "superscript" => __('superscript','tinycoffee'),
              "subscript" => __('subscript','tinycoffee'),
              "eraser" => __('eraser','tinycoffee'),
              "puzzle-piece" => __('puzzle-piece','tinycoffee'),
              "microphone" => __('microphone','tinycoffee'),
              "microphone-slash" => __('microphone-slash','tinycoffee'),
              "shield" => __('shield','tinycoffee'),
              "calendar-o" => __('calendar-o','tinycoffee'),
              "fire-extinguisher" => __('fire-extinguisher','tinycoffee'),
              "rocket" => __('rocket','tinycoffee'),
              "maxcdn" => __('maxcdn','tinycoffee'),
              "chevron-circle-left" => __('chevron-circle-left','tinycoffee'),
              "chevron-circle-right" => __('chevron-circle-right','tinycoffee'),
              "chevron-circle-up" => __('chevron-circle-up','tinycoffee'),
              "chevron-circle-down" => __('chevron-circle-down','tinycoffee'),
              "html5" => __('html5','tinycoffee'),
              "css3" => __('css3','tinycoffee'),
              "anchor" => __('anchor','tinycoffee'),
              "unlock-alt" => __('unlock-alt','tinycoffee'),
              "bullseye" => __('bullseye','tinycoffee'),
              "ellipsis-h" => __('ellipsis-h','tinycoffee'),
              "ellipsis-v" => __('ellipsis-v','tinycoffee'),
              "rss-square" => __('rss-square','tinycoffee'),
              "play-circle" => __('play-circle','tinycoffee'),
              "ticket" => __('ticket','tinycoffee'),
              "minus-square" => __('minus-square','tinycoffee'),
              "minus-square-o" => __('minus-square-o','tinycoffee'),
              "level-up" => __('level-up','tinycoffee'),
              "level-down" => __('level-down','tinycoffee'),
              "check-square" => __('check-square','tinycoffee'),
              "pencil-square" => __('pencil-square','tinycoffee'),
              "external-link-square" => __('external-link-square','tinycoffee'),
              "share-square" => __('share-square','tinycoffee'),
              "compass" => __('compass','tinycoffee'),
              "caret-square-o-down" => __('caret-square-o-down','tinycoffee'),
              "caret-square-o-up" => __('caret-square-o-up','tinycoffee'),
              "caret-square-o-right" => __('caret-square-o-right','tinycoffee'),
              "eur" => __('eur','tinycoffee'),
              "gbp" => __('gbp','tinycoffee'),
              "usd" => __('usd','tinycoffee'),
              "inr" => __('inr','tinycoffee'),
              "jpy" => __('jpy','tinycoffee'),
              "rub" => __('rub','tinycoffee'),
              "krw" => __('krw','tinycoffee'),
              "btc" => __('btc','tinycoffee'),
              "file" => __('file','tinycoffee'),
              "file-text" => __('file-text','tinycoffee'),
              "sort-alpha-asc" => __('sort-alpha-asc','tinycoffee'),
              "sort-alpha-desc" => __('sort-alpha-desc','tinycoffee'),
              "sort-amount-asc" => __('sort-amount-asc','tinycoffee'),
              "sort-amount-desc" => __('sort-amount-desc','tinycoffee'),
              "sort-numeric-asc" => __('sort-numeric-asc','tinycoffee'),
              "sort-numeric-desc" => __('sort-numeric-desc','tinycoffee'),
              "thumbs-up" => __('thumbs-up','tinycoffee'),
              "thumbs-down" => __('thumbs-down','tinycoffee'),
              "youtube-square" => __('youtube-square','tinycoffee'),
              "youtube" => __('youtube','tinycoffee'),
              "xing" => __('xing','tinycoffee'),
              "xing-square" => __('xing-square','tinycoffee'),
              "youtube-play" => __('youtube-play','tinycoffee'),
              "dropbox" => __('dropbox','tinycoffee'),
              "stack-overflow" => __('stack-overflow','tinycoffee'),
              "instagram" => __('instagram','tinycoffee'),
              "flickr" => __('flickr','tinycoffee'),
              "adn" => __('adn','tinycoffee'),
              "bitbucket" => __('bitbucket','tinycoffee'),
              "bitbucket-square" => __('bitbucket-square','tinycoffee'),
              "tumblr" => __('tumblr','tinycoffee'),
              "tumblr-square" => __('tumblr-square','tinycoffee'),
              "long-arrow-down" => __('long-arrow-down','tinycoffee'),
              "long-arrow-up" => __('long-arrow-up','tinycoffee'),
              "long-arrow-left" => __('long-arrow-left','tinycoffee'),
              "long-arrow-right" => __('long-arrow-right','tinycoffee'),
              "apple" => __('apple','tinycoffee'),
              "windows" => __('windows','tinycoffee'),
              "android" => __('android','tinycoffee'),
              "linux" => __('linux','tinycoffee'),
              "dribbble" => __('dribbble','tinycoffee'),
              "skype" => __('skype','tinycoffee'),
              "foursquare" => __('foursquare','tinycoffee'),
              "trello" => __('trello','tinycoffee'),
              "female" => __('female','tinycoffee'),
              "male" => __('male','tinycoffee'),
              "gittip" => __('gittip','tinycoffee'),
              "sun-o" => __('sun-o','tinycoffee'),
              "moon-o" => __('moon-o','tinycoffee'),
              "archive" => __('archive','tinycoffee'),
              "bug" => __('bug','tinycoffee'),
              "vk" => __('vk','tinycoffee'),
              "weibo" => __('weibo','tinycoffee'),
              "renren" => __('renren','tinycoffee'),
              "pagelines" => __('pagelines','tinycoffee'),
              "stack-exchange" => __('stack-exchange','tinycoffee'),
              "arrow-circle-o-right" => __('arrow-circle-o-right','tinycoffee'),
              "arrow-circle-o-left" => __('arrow-circle-o-left','tinycoffee'),
              "caret-square-o-left" => __('caret-square-o-left','tinycoffee'),
              "dot-circle-o" => __('dot-circle-o','tinycoffee'),
              "wheelchair" => __('wheelchair','tinycoffee'),
              "vimeo-square" => __('vimeo-square','tinycoffee'),
              "try" => __('try','tinycoffee'),
              "plus-square-o" => __('plus-square-o','tinycoffee'),
            )
          )
        ),
        array(
          'slug'              => 'hash',
          'title'             => __('Hash','tinycoffee'),
          'type'              => 'text',
        ),
        array(
          'slug'              => 'currency',
          'title'             => __('Currency template','tinycoffee'),
          'type'              => 'text',
        ),
        array(
          'slug'              => 'price',
          'title'             => __('Coffee price','tinycoffee'),
          'type'              => 'text',
          'description'       => __('How much is a single cup of your favorite coffee?','tinycoffee'),
        ),
      )
    ),
    array( 
      'slug'              => 'paypal',
      'title'             => __('Paypal Settings','tinycoffee'),
      'field'             => array(
        array(
          'slug'              => 'email',
          'title'             => __('Paypal username','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'currency',
          'title'             => __('Paypal currency','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'exchange',
          'title'             => __('Exchange rate','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'text',
          'title'             => __('Payment text','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'testing',
          'title'             => __('Sandbox mode','tinycoffee'),
          'type'              => 'checkbox'
        ),
      )
    ),
    array( 
      'slug'              => 'callback',
      'title'             => __('Callback Settings','tinycoffee'),
      'field'             => array(
        array(
          'slug'              => 'success',
          'title'             => __('Success callback','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'cancel',
          'title'             => __('Cancel callback','tinycoffee'),
          'type'              => 'text'
        ),
        array(
          'slug'              => 'activate',
          'title'             => __('Activate','tinycoffee'),
          'type'              => 'checkbox_list',
          'options'           => array(
            'list'              => array(
              'template_tag'      => __('Template tag','tinycoffee'),
              'shortcode'         => __('Shortcode','tinycoffee'),
              'modal_view'        => __('Modal dialog','tinycoffee'),
              'widget'            => __('Widget','tinycoffee'),
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
