<a
	href="#TB_inline?width=450&inlineId=pronamic-feed-reader-shortcode-inserter"
	class="button thickbox"
	title="<?php _e( 'Insert a product feed', 'pronamic_feed_reader' ); ?>"
    style="padding-left: .4em;"
>
	<img
		src="<?php //echo SlideshowPluginMain::getPluginUrl() . '/images/SlideshowPluginPostType/adminIcon.png'; ?>"
	    style="vertical-align: text-top;"
	/>
	<?php _e('Insert product feed', 'pronamic_feed_reader'); ?>
</a>

<div id="pronamic-feed-reader-shortcode-inserter" style="display: none;">

	<div class="pronamic-feed-reader-shortcode-inserter">
	
		<div class="search-area">
	
			<input type="text" class="search-bar" />
			
			<input type="button" class="search-button button button-secondary" value="<?php _e( 'Preview', 'pronamic_feed_reader' ); ?>" />
			
			<input type="button" class="insert-button button button-primary" value="<?php _e( 'Insert', 'pronamic_feed_reader' ); ?>" />
			
	    </div>
	    
	    <div class="options-area">
	    
	    	<div class="option">
			    <label for="pronamic_feed_reader_shortcode_inserter_show_title"><?php _e( 'Show title', 'pronamic_feed_reader' ); ?></label>
		    	<input type="checkbox" value="true" checked="checked" class="show-title" id="pronamic_feed_reader_shortcode_inserter_show_title" />
		    </div>
	    	
	    	<div class="option">
		    	<label for="pronamic_feed_reader_shortcode_inserter_show_description"><?php _e( 'Show description', 'pronamic_feed_reader' ); ?></label>
		    	<input type="checkbox" value="true" class="show-description" id="pronamic_feed_reader_shortcode_inserter_show_description" />
	    	</div>
	    	
	    	<div class="option">
		    	<label for="pronamic_feed_reader_shortcode_inserter_show_enclosure"><?php _e( 'Show enclosure', 'pronamic_feed_reader' ); ?></label>
		    	<input type="checkbox" value="true" checked="checked" class="show-enclosure" id="pronamic_feed_reader_shortcode_inserter_show_enclosure" />
	    	</div>
	    	
	    	<div class="option">
		    	<label for="pronamic_feed_reader_shortcode_inserter_link_active"><?php _e( 'Link to product', 'pronamic_feed_reader' ); ?></label>
		    	<input type="checkbox" value="true" checked="checked" class="link-active" id="pronamic_feed_reader_shortcode_inserter_link_active" />
	    	</div>
	    	
	    	<div class="option">
		    	<label for="pronamic_feed_reader_shortcode_inserter_link_target"><?php _e( 'Open link in', 'pronamic_feed_reader' ); ?></label>
		    	<select class="link-target" id="pronamic_feed_reader_shortcode_inserter_link_target">
			    	
			    	<option value="_self" selected="selected"><?php _e( 'Same window', 'pronamic_feed_reader' ); ?></option>
			    	<option value="_blank"><?php _e( 'New window', 'pronamic_feed_reader' ); ?></option>
			    	
		    	</select>
	    	</div>
	    	
	    	<div class="option">
		    	<label for="pronamic_feed_reader_shortcode_inserter_limit"><?php _e( 'Maximum number of products', 'pronamic_feed_reader' ); ?></label>
		    	<input type="text" size="4" value="4" class="limit" id="pronamic_feed_reader_shortcode_inserter_limit" />
	    	</div>
	    
	    </div>
			
		<div class="feed-block-preview-area"></div>

    </div>
    
</div>