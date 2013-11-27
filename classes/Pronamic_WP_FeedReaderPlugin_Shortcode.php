<?php

class Pronamic_WP_FeedReaderPlugin_Shortcode
{
	/**
	 * The plugin
	 * 
	 * @var Pronamic_WP_FeedReaderPlugin
	 */
	protected $plugin;
	
	/**
	 * The shortcode
	 * 
	 * @var string
	 */
	protected $shortcode = 'bouwproducten';
	
	/**
	 * Constructor
	 * 
	 * @param $plugin
	 */
	public function __construct( $plugin )
	{
		$this->plugin = $plugin;
		
		add_shortcode( $this->shortcode, array( $this, 'handle_shortcode' ) );
		
		if ( is_admin() )
		{
			add_action( 'media_buttons', array( $this, 'shortcode_inserter' ), 11 );
		
			add_action( 'wp_ajax_pronamic_feed_reader_preview_feed_block', array( $this, 'ajax_preview_feed_block' ) );
		}
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * 
	 */
	public function handle_shortcode( $args )
	{
		$feed_block = new Pronamic_WP_FeedReaderPlugin_FeedBlock( $this->plugin );
		
		$feed_block->set( $args );
		
		return $feed_block->generate_feed_block();
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * Outputs the HTML and enqueues the scripts and stylesheets for the shortcode inserter.
	 */
	public function shortcode_inserter()
	{
		wp_enqueue_script(
			'Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter',
			plugins_url( 'admin' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'shortcode_inserter.js', $this->plugin->file ),
			array( 'jquery' ),
			$this->plugin->version
		);
		
		wp_localize_script(
			'Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter',
			'Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter_data',
			array(
				'shortcode' => $this->shortcode
			)
		);
		
		wp_localize_script(
			'Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter',
			'Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter_strings',
			array(
				'noItemsFound'                => __( 'No products found', 'pronamic_feed_reader' ),
				'noFeedBlockPreviewAvailable' => __( 'The product feed preview is currently unavailable', 'pronamic_feed_reader' )
			)
		);
		
		wp_enqueue_style(
			'Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter',
			plugins_url( 'admin' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'shortcode_inserter.css', $this->plugin->file ),
			array(),
			$this->plugin->version
		);
		
		include $this->plugin->path . 'admin' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'shortcode_inserter.php';
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * Called on an AJAX request, displays a preview of what a feed block
	 * would look like when the parameters are set like they are in $_POST. 
	 */
	public function ajax_preview_feed_block()
	{
		$feed_block = new Pronamic_WP_FeedReaderPlugin_FeedBlock( $this->plugin );
		
		$feed_block->set( $_POST );
		
		echo $feed_block->generate_feed_block();
		
		die();
	}
}