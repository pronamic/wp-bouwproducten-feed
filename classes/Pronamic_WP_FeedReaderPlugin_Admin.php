<?php

class Pronamic_WP_FeedReaderPlugin_Admin
{
	/**
	 * The plugin
	 *
	 * @var Pronamic_WP_FeedReaderPlugin
	 */
	private $plugin;

	/**
	 * Constructs and intializes an Pronamic Post Like plugin
	 *
	 * @param string $file
	 */
	public function __construct( $plugin )
	{
		$this->plugin = $plugin;

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		
		add_action( 'save_post', array( $this, 'save_product_feed_meta' ), 10, 2 );
		
		//add_action( 'admin_init', array( $this, 'admin_init' ) );
		//add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		//add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	//////////////////////////////////////////////////
	
	/**
	 * Add meta boxes
	 */
	public function add_meta_boxes()
	{
		$screens = array( 'post', 'page' );
		
		foreach ( $screens as $screen )
		{
			add_meta_box(
				'pronamic_feed_reader_product_feed',
				__( 'Product feed', 'pronamic_feed_reader' ),
				array( $this, 'product_feed_meta_box' ),
				$screen,
				'normal'
			);
		}
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * Product feed meta box
	 */
	public function product_feed_meta_box()
	{
		include $this->plugin->path . 'admin' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'meta-box-product-feed.php';
	}

	//////////////////////////////////////////////////

	/**
	 * Save product feed meta
	 * 
	 * @param string $post_id
	 * @param WP_Post $post
	 */
	public function save_product_feed_meta( $post_id, $post )
	{
		// Doing autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		{
			return;
		}
	
		// Verify nonce
		$nonce = filter_input( INPUT_POST, 'pronamic_feed_reader_product_feed_meta_box_nonce', FILTER_SANITIZE_STRING );
		if ( ! wp_verify_nonce( $nonce, 'pronamic_feed_reader_product_feed_save' ) )
		{
			return;
		}
	
		// Check permissions
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	
		$data = filter_input_array( INPUT_POST, array(
			'_pronamic_feed_reader_product_feed_search'           => FILTER_SANITIZE_STRING,
			'_pronamic_feed_reader_product_feed_show_title'       => FILTER_VALIDATE_BOOLEAN,
			'_pronamic_feed_reader_product_feed_show_description' => FILTER_VALIDATE_BOOLEAN,
			'_pronamic_feed_reader_product_feed_show_enclosure'   => FILTER_VALIDATE_BOOLEAN,
			'_pronamic_feed_reader_product_feed_link_active'      => FILTER_VALIDATE_BOOLEAN,
			'_pronamic_feed_reader_product_feed_link_target'      => FILTER_SANITIZE_STRING,
			'_pronamic_feed_reader_product_feed_limit'            => FILTER_VALIDATE_INT
		) );
		
		foreach ( $data as $key => $value )
		{
			if ( empty( $value ) )
			{
				delete_post_meta( $post_id, $key );
			}
			else
			{
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}
