=== tinyCoffee ===
Contributors: ideag, kucrut
Donate link: https://www.patreon.com/arunas
Tags: donate, donate button, paypal donate, paypal, coffee, donate widget, donate shortcode
Requires at least: 3.0.1
Tested up to: 4.7.2
Stable tag: 0.2.2
License: MIT
License URI: http://opensource.org/licenses/MIT

A WordPress donate button plugin with a twist - ask your supporters to treat you to a coffee, beer or other beverage of your choice.

== Description ==

Ask your supporters to treat you to a cup of coffee, pint of beer or some other simple treat. It is a more creative way to ask for donations via PayPal.

You can use this as:

*   Template tag `get_coffee()`/`the_coffee()`
*   Shortcode `[coffee]`/`[tiny_coffee]`
*   Sidebar widget
*   Hash-activated modal screen (domain.com#coffee)

If you like my work and want to support development of my open source WordPress plugins, please consider becoming my patron at [Patreon](https://www.patreon.com/arunas).

Also, try out my other plugins:

* [Gust](http://tiny.lt/gust) - a Ghost-like admin panel for WordPress, featuring Markdown based split-view editor.
* [tinySocial](http://tiny.lt/tinysocial) - a simple way to add social sharing linkst to Your WordPress posts via shortcodes.
* [tinyTOC](http://tiny.lt/tinytoc) - automatic Table of Contents, based on H1-H6 headings in post content.
* [tinyIP](http://tiny.lt/tinyip) - *Premium* - stop WordPress users from sharing login information, force users to be logged in only from one device at a time.

== Installation ==

1. Upload `tinycoffee` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Setup your information in `Settings > tinyCoffee`
1. Add to your website via template tag, shortcode, widget or modal view.

== Frequently Asked Questions ==


== Changelog ==

= 0.2.2 =
fixed FontAwesome version check WP Cron task
updated FontAwesome version to 4.7.0

= 0.2.1 =
updated FontAwesome version to 4.3.0;
added methods to update FontAwesome version automatically when it is released;

= 0.2.0 =
Modified JavaScript to better handle the hash-activated modal dialog - contributed by Neil Foster (@mokummusic);
Added a `tinycoffee_options` filter that can be used to modify all options that are used to build the tinyCoffee form and request to PayPal;
Cleaned up a `notice` in the widget;

= 0.1.5 =
Removed a stray TAB symbol

= 0.1.4 =
Add option for default amount of cups

= 0.1.3 =
Remove modal header bottom border

= 0.1.2 =
code cleanup, courtesy of Dzikri Aziz (kucrut)

= 0.1.1 =
widget related bug fixes, courtesy of Dzikri Aziz (kucrut)

= 0.1 =
Initial release

== Upgrade Notice ==

No upgrade notices

== Screenshots ==
1. Inside a post/page
2. In sidebar of Twenty Fourteen theme
3. As a modal view (domain.com#coffee)
