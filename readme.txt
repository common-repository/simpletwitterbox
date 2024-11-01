=== SimpleTwitterBox ===
Contributors: Patrick Simpson
Donate link: http://patricksimpson.nl/
Tags: twitter
Requires at least: 2.0.2
Tested up to: 2.7.1
Stable tag: 1.0

Does just what is says on the tin. And nothing more.

== Description ==

A very simple plugin to display a twitter box in the sidebar. The prime reason for the existence
of this plugin is that I wanted to try to write a plugin. It is decent enough to be used, so I've
published it.

The only configuration it supports are the Twitter username, number of updates and an optional HTML footer
and header.

For bug reports or general comments, feel free to contact me at wordpress@patricksimpson.nl

== Installation ==

1. Save the `simple_twitter_box.php` file in  the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add the widget through the 'Appearance > Widgets' menu in WordPress.
1. Set your Twitter username in the widget's prefences.
1. You may want to edit your CSS to change the appearance of the box. The widget is the standard 
Twitter badge (http://twitter.com/badges) and there are plenty of CSS examples for it on the web.

== Frequently Asked Questions ==

= The Twitter box does not show up in my sidebar =

If you did not specify your Twitter username, the box will be empty

= Can you make it prettier? =

No, edit your CSS to change the appearance. 

= What are the footer and header for =

You can use them to add HTML before and after the box. If any content is specified, it will be enclosed in a link
to your Twitter feed.

== Screenshots ==

1. This is what it looks like out of the box.
2. And this is what it looks like on my [site](http://patricksimpson.nl) with some simple CSS.
