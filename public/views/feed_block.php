<?php if ( $data instanceof stdClass ): ?>

<div class="feed-block">

	<?php foreach( $data->feed_items as $feed_item ): ?>

	<?php
	
	$anchor_open = $anchor_close = '';
	
	if ( $data->link_active )
	{
		$anchor_open  = '<a href="' . $feed_item->get_link() . '" target="' . htmlspecialchars( $data->link_target ) . '">';
		$anchor_close = '</a>';
	}
	
	?>

	<div class="feed-block-feed-item">
	
		<?php if ( $data->show_title ): ?>
		<div class="feed-block-feed-item-title"><?php echo $anchor_open; ?><?php echo $feed_item->get_title(); ?><?php echo $anchor_close; ?></div>
		<?php endif; ?>
		
		<?php if ( $data->show_description ): ?>
		<div class="feed-block-feed-item-description"><?php echo $feed_item->get_description(); ?></div>
		<?php endif;?>
		
		<?php if ( $data->show_enclosure ): ?>
		<div class="feed-block-feed-item-enclosure">
		
			<?php echo $anchor_open; ?>
				<img
					src="<?php echo $feed_item->get_enclosure()->get_link(); ?>"
					alt="<?php echo $feed_item->get_title(); ?>"
				/>
			<?php echo $anchor_close; ?>
			
		</div>
		<?php endif; ?>
		
	</div>

	<?php endforeach; ?>

</div>

<?php endif; ?>