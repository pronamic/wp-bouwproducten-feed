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
		
		add_filter( 'the_content', array( $this, 'add_product_feed_to_the_content' ) );
		
		new Pronamic_WP_FeedReaderPlugin_Shortcode( $this );
		
		if ( is_admin() )
		{
			new Pronamic_WP_FeedReaderPlugin_Admin( $this );
		}
	}
	
	//////////////////////////////////////////////////

	/**
	 * Plugins loaded
	 */
	public function plugins_loaded()
	{
		load_plugin_textdomain( 'pronamic_feed_reader', false, dirname( plugin_basename( $this->file ) ) . '/languages/' );
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * Adds a product feed to the content when a search key is set in the post's meta box.
	 * 
	 * @param string $content
	 */
	public function add_product_feed_to_the_content( $content )
	{
		global $post;
		
		$search = get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_search', true );
		
		if ( !isset( $search ) ||
			 strlen( $search ) <= 0 )
		{
		 	return $content;
		}
		
		$feed_block = new Pronamic_WP_FeedReaderPlugin_FeedBlock( $this, array(
			'search'           => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_search'          , true ),
			'show_title'       => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_show_title'      , true ),
			'show_description' => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_show_description', true ),
			'show_enclosure'   => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_show_enclosure'  , true ),
			'link_active'      => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_link_active'     , true ),
			'link_target'      => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_link_target'     , true ),
			'limit'            => get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_limit'           , true )
		) );
		
		return $content . $feed_block->generate_feed_block();
	}
}
