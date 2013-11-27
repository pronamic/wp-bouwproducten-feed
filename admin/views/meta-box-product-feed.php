<?php

global $post;

wp_nonce_field( 'pronamic_feed_reader_product_feed_save', 'pronamic_feed_reader_product_feed_meta_box_nonce' );

?>

<table class="form-table">

	<tr valign="top">
	
		<th scope="row">
			<label for="_pronamic_feed_reader_product_feed_search"><?php _e( 'Search words', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<input
				type="text"
				id="_pronamic_feed_reader_product_feed_search"
				name="_pronamic_feed_reader_product_feed_search"
				value="<?php echo htmlspecialchars( get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_search', true ) ); ?>"
				class="widefat"
			/>
		</td>
		
	</tr>
	
	<tr valign="top">
	
		<th scope="row">
			<label for="_pronamic_feed_reader_product_feed_show_title"><?php _e( 'Show title', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<input
				type="checkbox"
				id="_pronamic_feed_reader_product_feed_show_title"
				name="_pronamic_feed_reader_product_feed_show_title"
				<?php checked( true, get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_show_title', true ) ); ?>
				value="true"
			/>
		</td>
		
	</tr>
	
	<tr valign="top">
	
		<th scope="row">
			<label for="_pronamic_feed_reader_product_feed_show_description"><?php _e( 'Show description', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<input
				type="checkbox"
				id="_pronamic_feed_reader_product_feed_show_description"
				name="_pronamic_feed_reader_product_feed_show_description"
				<?php checked( true, get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_show_description', true ) ); ?>
				value="true"
			/>
		</td>
		
	</tr>
	
	<tr valign="top">
	
		<th scope="row">
			<label for="_pronamic_feed_reader_product_feed_show_enclosure"><?php _e( 'Show enclosure', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<input
				type="checkbox"
				id="_pronamic_feed_reader_product_feed_show_enclosure"
				name="_pronamic_feed_reader_product_feed_show_enclosure"
				<?php checked( true, get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_show_enclosure', true ) ); ?>
				value="true"
			/>
		</td>
		
	</tr>
	
	<tr valign="top">
	
		<th scope="row">
			<label for="_pronamic_feed_reader_product_feed_link_active"><?php _e( 'Link to product', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<input
				type="checkbox"
				id="_pronamic_feed_reader_product_feed_link_active"
				name="_pronamic_feed_reader_product_feed_link_active"
				<?php checked( true, get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_link_active', true ) ); ?>
				value="true"
			/>
		</td>
		
	</tr>
	
	<tr valign="top">
	
		<th scope="row">
			<label for="_pronamic_feed_reader_product_feed_link_target"><?php _e( 'Open link in', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<?php $current_link_target = get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_link_target', true ); ?>
			<select class="link-target" id="_pronamic_feed_reader_product_feed_link_target" name="_pronamic_feed_reader_product_feed_link_target">
		    	
		    	<option value="_self" <?php selected( '_self', $current_link_target ); ?>><?php _e( 'Same window', 'pronamic_feed_reader' ); ?></option>
		    	<option value="_blank" <?php selected( '_blank', $current_link_target ); ?>><?php _e( 'New window', 'pronamic_feed_reader' ); ?></option>
		    	
	    	</select>
		</td>
		
	</tr>
	
	<tr valign="top">
	
		<th scope="row">
			<label for=""><?php _e( 'Limit', 'pronamic_feed_reader' ); ?></label>
		</th>
		
		<td>
			<input
				type="text"
				id="_pronamic_feed_reader_product_feed_limit"
				name="_pronamic_feed_reader_product_feed_limit"
				value="<?php echo htmlspecialchars( get_post_meta( $post->ID, '_pronamic_feed_reader_product_feed_limit', true ) ); ?>"
				size="4"
			/>
		</td>
		
	</tr>
	
</table>