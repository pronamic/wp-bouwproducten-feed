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
	 * For documentation on the $options parameter, see the $this->set( $options ) method.
	 * 
	 * @param Pronamic_WP_FeedReaderPlugin
	 * @param mixed
	 */
	public function __construct( $plugin, $options = array() )
	{
		$this->plugin = $plugin;
		
		if ( count( $options ) > 0 )
		{
			$this->set( $options );
		}
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
		
		ob_start();
		include $this->plugin->path . 'public' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'feed_block.php';
		return ob_get_clean();
	}
	
	////////////////////////////////////////////////
	
	/**
	 * Sets the local variables to the values passed in the $options array.
	 * 
	 * The $options array can have the following keys:
	 * 
	 * - search           string
	 * - show_title       bool
	 * - show_description bool
	 * - show_enclosure   bool
	 * - link_active      bool
	 * - link_target      string
	 * - limit            int
	 * 
	 * @param mixed $options
	 */
	public function set( $options )
	{
		$options = filter_var_array( $options, array(
			'search'           => FILTER_SANITIZE_STRING,
			'show_title'       => FILTER_VALIDATE_BOOLEAN,
			'show_description' => FILTER_VALIDATE_BOOLEAN,
			'show_enclosure'   => FILTER_VALIDATE_BOOLEAN,
			'link_active'      => FILTER_VALIDATE_BOOLEAN,
			'link_target'      => FILTER_SANITIZE_STRING,
			'limit'            => FILTER_VALIDATE_INT
		) );
		
		if ( strlen( $options[ 'search' ] ) > 0 )
		{
			$this->url = 'http://bouwproducten.nl/rss.search.php?query=' . $options[ 'search' ];
		}
		else 
		{
			$this->url = '';
		}
		
		$this->show_title       = $options[ 'show_title' ];
		$this->show_description = $options[ 'show_description' ];
		$this->show_enclosure   = $options[ 'show_enclosure' ];
		$this->link_active      = $options[ 'link_active' ];
		
		if ( strlen( $options[ 'link_target' ] ) > 0 )
		{
			$this->link_target = $options[ 'link_target' ];
		}
		else
		{
			$this->link_target = '_self';
		}
		
		if ( $options[ 'limit' ] > 0 )
		{
			$this->set_limit( $options[ 'limit' ] );
		}
		else
		{
			$this->set_limit( 0 );
		}
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