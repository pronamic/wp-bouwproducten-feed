Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter = function()
{
	var $    = jQuery,
		self = { };
	
	/**
	 * Initialize the shortcode inserter
	 */
	self.init = function()
	{
		self.data    = Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter_data;
		self.strings = Pronamic_WP_FeedReaderPlugin_Shortcode_shortcode_inserter_strings;
		
		if (typeof self.data !== 'object')
		{
			self.data = { };
		}
		
		if (typeof self.strings !== 'object')
		{
			self.strings = { };
		}
		
		// Elements
		self.$shortcodeInserter = $('#pronamic-feed-reader-shortcode-inserter');
		
		self.$searchBar    = self.$shortcodeInserter.find('.search-bar');
		self.$searchButton = self.$shortcodeInserter.find('.search-button');
		self.$insertButton = self.$shortcodeInserter.find('.insert-button');
		
		self.options                  = { };
		self.options.optionsArea      = self.$shortcodeInserter.find('.options-area');
		self.options.$showTitle       = self.options.optionsArea.find('.show-title');
		self.options.$showDescription = self.options.optionsArea.find('.show-description');
		self.options.$showEnclosure   = self.options.optionsArea.find('.show-enclosure');
		self.options.$linkActive      = self.options.optionsArea.find('.link-active');
		self.options.$linkTarget      = self.options.optionsArea.find('.link-target');
		self.options.$limit           = self.options.optionsArea.find('.limit');
		
		self.$feedBlockPreviewArea = self.$shortcodeInserter.find('.feed-block-preview-area');
		
		// Listeners
		self.$searchBar.on('keydown', function(event){ if (event.keyCode === 13) self.handleSearchEvent(event); });
		self.$searchButton.on('click', self.handleSearchEvent);
		self.$insertButton.on('click', self.handleInsertEvent);
		
		self.options.$showTitle      .on('change', self.handleSearchEvent);
		self.options.$showDescription.on('change', self.handleSearchEvent);
		self.options.$showEnclosure  .on('change', self.handleSearchEvent);
		self.options.$linkActive     .on('change', self.handleSearchEvent);
		self.options.$linkTarget     .on('change', self.handleSearchEvent);
		self.options.$limit          .on('change', self.handleSearchEvent);
	};
	
	/**
	 * Handles a search event
	 * 
	 * @param event
	 */
	self.handleSearchEvent = function(event)
	{
		event.preventDefault();
		
		var search          = self.$searchBar.val(),
			showTitle       = self.options.$showTitle.is(':checked'),
			showDescription = self.options.$showDescription.is(':checked'),
			showEnclosure   = self.options.$showEnclosure.is(':checked'),
			linkActive      = self.options.$linkActive.is(':checked'),
			linkTarget      = self.options.$linkTarget.val(),
			limit           = self.options.$limit.val();
		
		if (search.length <= 0)
		{
			return;
		}
		
		if (typeof self.searchEventXHRObject === 'object')
		{
			self.searchEventXHRObject.abort();
		}
		
		self.searchEventXHRObject = $.post(
			ajaxurl,
			{
				'action'          : 'pronamic_feed_reader_preview_feed_block',
				'search'          : search,
				'show_title'      : showTitle,
				'show_description': showDescription,
				'show_enclosure'  : showEnclosure,
				'link_active'     : linkActive,
				'link_target'     : linkTarget,
				'limit'           : limit
			}
		)
		.done(function(data)
		{
			var limit;
			
			data = $.trim(data);
			
			if (data.length > 0 &&
				data !== 0)
			{
				self.$feedBlockPreviewArea.html(data);
				
				self.renewFeedBlockPreviewAreaStyling();
			}
			else
			{
				if (typeof self.strings.noItemsFound === 'string')
				{
					self.$feedBlockPreviewArea.html(self.strings.noItemsFound);
				}
			}
		})
		.fail(function()
		{
			if (typeof self.strings.noFeedBlockPreviewAvailable === 'string')
			{
				self.$feedBlockPreviewArea.text(self.strings.noFeedBlockPreviewAvailable);
			}
		});
	};
	
	/**
	 * Styles the feed block preview area so all products line up next to one another
	 */
	self.renewFeedBlockPreviewAreaStyling = function()
	{
		var $feedBlockItems = self.$feedBlockPreviewArea.find('.feed-block-feed-item'),
			numberOfProducts;
		
		if ($feedBlockItems.length > 0)
		{
			$feedBlockItems.css('width', (100 / $feedBlockItems.length) + '%');
		}
	};
	
	/**
	 * Handles an insert event
	 * 
	 * @param event
	 */
	self.handleInsertEvent = function(event)
	{
		event.preventDefault();
		
		var shortcode       = 'bouwproducten',
			search          = self.$searchBar.val(),
			showTitle       = self.options.$showTitle.is(':checked'),
			showDescription = self.options.$showDescription.is(':checked'),
			showEnclosure   = self.options.$showEnclosure.is(':checked'),
			linkActive      = self.options.$linkActive.is(':checked'),
			linkTarget      = self.options.$linkTarget.val(),
			limit           = self.options.$limit.val();
		
		if (typeof self.data.shortcode === 'string')
		{
			shortcode = self.data.shortcode;
		}
		
		send_to_editor('['        +
			shortcode             +
			' search="'           + search          + '"' +
			' show_title="'       + showTitle       + '"' +
			' show_description="' + showDescription + '"' +
			' show_enclosure="'   + showEnclosure   + '"' +
			' link_active="'      + linkActive      + '"' +
			' link_target="'      + linkTarget      + '"' +
			' limit="'            + limit           + '"' +
		']');

        tb_remove();
	};
	
	/**
	 * Initialize on document ready
	 */
	$(document).ready(function()
	{
		self.init();
	});
}();