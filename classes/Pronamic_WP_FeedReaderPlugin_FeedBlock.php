<?php

class Pronamic_WP_FeedReaderPlugin_FeedBlock
{
	/**
	 * The plugin
	 * 
	 * @var Pronamic_WP_FeedReaderPlugin
	 */
	protected $plugin;
	
	/** @var string */
	protected $url = '';
	
	/** @var bool */
	protected $show_title = false;
	
	/** @var bool */
	protected $show_description = false;
	
	/** @var bool */
	protected $show_enclosure = false;
	
	/** @var bool */
	protected $link_active = false;
	
	/** @var string */
	protected $link_target = '';
	
	/** @var int */
	protected $limit = 0;
	
	/**
	 * Constructor
	 * 
	 * @param Pronamic_WP_FeedReaderPlugin
	 */
	public function __construct( $plugin )
	{
		$this->plugin = $plugin;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * Generates the block of unstyled HTML for a feed retrieved from the URL.
	 * 
	 * @return string
	 */
	public function generate_feed_block()
	{
		$feed = fetch_feed( $this->url );
		
		if ( is_wp_error( $feed ) )
		{
			return "";
		}
		
		$feed_item_quantity = $feed->get_item_quantity( $this->limit );
		
		if ( $feed_item_quantity <= 0 )
		{
			return "";
		}
		
		$data = new stdClass();
		
		$data->show_title       = $this->show_title;
		$data->show_description = $this->show_description;
		$data->show_enclosure   = $this->show_enclosure;
		$data->link_active      = $this->link_active;
		$data->link_target      = $this->link_target;
		$data->feed_items       = $feed->get_items( 0, $feed_item_quantity );
		
		include $this->plugin->path . 'public' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'feed_block.php';
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param string $url
	 */
	public function set_URL( $url )
	{
		$this->url = $url;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param bool $show_title
	 */
	public function set_show_title( $show_title )
	{
		$this->show_title = $show_title;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param bool $show_description
	 */
	public function set_show_description( $show_description )
	{
		$this->show_description = $show_description;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param bool $show_enclosure
	 */
	public function set_show_enclosure( $show_enclosure )
	{
		$this->show_enclosure = $show_enclosure;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param bool $link_active
	 */
	public function set_link_active( $link_active )
	{
		$this->link_active = $link_active;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param string $link_target
	 */
	public function set_link_target( $link_target )
	{
		$this->link_target = $link_target;
	}
	
	//////////////////////////////////////////////////
	
	/**
	 * @param int $limit
	 */
	public function set_limit( $limit )
	{
		if ( is_numeric( $limit ) )
		{
			$this->limit = intval($limit);
		}
		else
		{
			$this->limit = 0;
		}
	}
}