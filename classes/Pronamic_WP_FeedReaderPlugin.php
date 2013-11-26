<?php

class Pronamic_WP_FeedReaderPlugin
{
	/**
	 * The main plugin file
	 *
	 * @var string
	 */
	public $file;
	
	/**
	 * The plugin's version number
	 * 
	 * @var string
	 */
	public $version = "1.0.0";

	/**
	 * Constructs and intializes the Pronamic Feed Reader plugin
	 *
	 * @param string $file
	 */
	public function __construct( $file )
	{
		$this->file = $file;
		$this->path = plugin_dir_path( $file );

		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );

		//add_action( 'init', array( $this, 'init' ) );
		
		//add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
		new Pronamic_WP_FeedReaderPlugin_Shortcode( $this );
	}

	/**
	 * Plugins loaded
	 */
	public function plugins_loaded()
	{
		load_plugin_textdomain( 'pronamic_feed_reader', false, dirname( plugin_basename( $this->file ) ) . '/languages/' );
	}
}
