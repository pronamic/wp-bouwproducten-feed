<?php
/*
Plugin Name: Pronamic Feed Reader
Plugin URI: 
Description: 
 
Version: 1.0.0
Requires at least: 3.0

Author: Pronamic
Author URI: http://pronamic.eu/

Text Domain: pronamic_feed_reader
Domain Path: /languages/

License: GPL

GitHub URI: 
*/

require_once dirname( __FILE__ ) . '/classes/Pronamic_WP_FeedReaderPlugin.php';
require_once dirname( __FILE__ ) . '/classes/Pronamic_WP_FeedReaderPlugin_Admin.php';
require_once dirname( __FILE__ ) . '/classes/Pronamic_WP_FeedReaderPlugin_FeedBlock.php';
require_once dirname( __FILE__ ) . '/classes/Pronamic_WP_FeedReaderPlugin_Shortcode.php';

global $pronamic_feed_reader_plugin;

$pronamic_feed_reader_plugin = new Pronamic_WP_FeedReaderPlugin( __FILE__ );
