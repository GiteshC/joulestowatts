<?php
/**
 * Video Voices block
 * Vars available: $block, $content, $is_preview, $post_id
 */
$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="voicesSec"<?php echo $anchor; ?>>
	<?php if ( have_rows( 'video_content' ) ) : ?>
		<?php while ( have_rows( 'video_content' ) ) : the_row(); ?>
			<?php
				$video_link    = get_sub_field( 'video_link' );
				$video_heading = get_sub_field( 'video_box_heading' );
			?>
			<div class="voiceCard">
				<p><?php echo get_sub_field('video_link'); ?></p>
				<p><?php echo get_sub_field('video_box_heading'); ?></p>
				video block
				<!-- your existing .voicePlay / .voiceMeta markup goes here -->
			</div>
		<?php endwhile; ?>
	<?php elseif ( $is_preview ) : ?>
		<p>Add cards in the block sidebar.</p>
	<?php endif; ?>
</section>