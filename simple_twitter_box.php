<?php
/*
Plugin Name: SimpleTwitterBox
Plugin URI: http://patricksimpson.nl/simpletwitterbox
Description: Does just what is says on the tin. And nothing more.
Version: 1.0
Author: Patrick Simpson
Author URI: http://patricksimpson.nl
*/

/*  Copyright 2009 Patrick Simpson  (email : www@patricksimpson.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function init_simple_twitter_box()
{

	if (!function_exists('register_sidebar_widget'))
		return;


	// The main function for the widget
    function widget_simple_twitter_box($args) 
	{
		extract( $args );
		$options = get_option('widget_simple_twitter_box');

		// Extract the options
		$header = $options['header'];
		$footer = $options['footer'];
		$username = htmlspecialchars($options['username'], ENT_QUOTES);
		$number_of_tweets = htmlspecialchars($options['number_of_tweets'], ENT_QUOTES);
		if (!is_numeric($number_of_tweets))
			$number_of_tweets = 5;
		
		// If not configured, do nothing
		if (empty($username))
			return;
		// Output the HTML.
		// Twitter badge generated from http://twitter.com/badges
    ?>
	    <?php echo $before_widget; ?>
		    <?php echo $before_title . __('Twitter') . $after_title; ?>
			<div id="twitter_div">
				<?php if (!empty($header)) {?>
					<div id="twitter_link_header"><a href="http://twitter.com/<?php echo $username?>"><?php echo $header?></a></div>
				<?php } ?>

				<ul id="twitter_update_list"></ul>
				
				<?php if (!empty($footer)) {?>
					<div id="twitter_link_footer"><a href="http://twitter.com/<?php echo $username?>"><?php echo $footer?></a></div>
                                <?php } ?>
			</div>
			<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username?>.json?callback=twitterCallback2&amp;count=<?php echo $number_of_tweets?>"></script>
	    <?php echo $after_widget; ?>
    <?php
	}
	
	// The preferences form
	function widget_simple_twitter_box_control() 
	{
		$options = get_option('widget_simple_twitter_box');

		// Set default options if none are specified yet
		if ( !is_array($options) )
			$options = array('header'=>'', 
						     'footer'=>__('Follow me on Twitter'), 
							 'username'=>'', 
							 'number_of_tweets'=>5);
		
		// Store options if they are submitted
		if ( $_POST['widget_simple_twitter_box_submit'] ) 
		{

			$options['header'] = stripslashes($_POST['widget_simple_twitter_box_header']);
			$options['footer'] = stripslashes($_POST['widget_simple_twitter_box_footer']);
			$options['username'] = strip_tags(stripslashes($_POST['widget_simple_twitter_box_username']));
			
			// Only store amount if it is really a number
			$number_of_tweets_tmp = strip_tags(stripslashes($_POST['widget_simple_twitter_box_number_of_tweets']));
			if (is_numeric($number_of_tweets_tmp))
				$options['number_of_tweets'] = $number_of_tweets_tmp;
			update_option('widget_simple_twitter_box', $options);
		}

		// Extract options for form
		$header = htmlspecialchars($options['header'], ENT_QUOTES);
		$footer = htmlspecialchars($options['footer'], ENT_QUOTES);
		$username = htmlspecialchars($options['username'], ENT_QUOTES);
		$number_of_tweets = htmlspecialchars($options['number_of_tweets'], ENT_QUOTES);
		if (!is_numeric($number_of_tweets))
			$number_of_tweets = 5;

		// Write the form
		?>
			<p style="text-align:right;">
				<label for="widget_simple_twitter_box_username">
					<?php echo __('Username:')?>
				</label>
				<input style="width: 150px;" type="text" id="widget_simple_twitter_box_username" 
					   name="widget_simple_twitter_box_username" value="<?php echo $username?>" />
			</p>
			
			<p style="text-align:right;">
				<label for="widget_simple_twitter_box_number_of_tweets">
					<?php echo __('Tweets:')?>
				</label>
				<input style="width: 150px;" type="text" id="widget_simple_twitter_box_number_of_tweets" 
					   name="widget_simple_twitter_box_number_of_tweets" value="<?php echo $number_of_tweets?>" />
			</p>
			
			<p style="text-align:right;">
				<label for="widget_simple_twitter_box_header">
					<?php echo __('Header:')?>
				</label>
				<input style="width: 150px;" type="text" id="widget_simple_twitter_box_header" 
					   name="widget_simple_twitter_box_header" value="<?php echo $header?>" />
			</p>

			<p style="text-align:right;">
				<label for="widget_simple_twitter_box_footer">
					<?php echo __('Footer:')?>
				</label>
				<input style="width: 150px;" type="text" id="widget_simple_twitter_box_footer" 
					   name="widget_simple_twitter_box_footer" value="<?php echo $footer?>" />
			</p>

			<input type="hidden" id="widget_simple_twitter_box_submit" name="widget_simple_twitter_box_submit" value="1" />
		<?php
	}
		
	// Register the widget and preferences form
    wp_register_sidebar_widget('widget_simple_twitter_box', __('SimpleTwitterBox'), 'widget_simple_twitter_box',
								array('description' => __('Displays the last few tweets of your Twitter feed')));
	register_widget_control('widget_simple_twitter_box', 'widget_simple_twitter_box_control');
}
add_action('plugins_loaded', 'init_simple_twitter_box');
?>
