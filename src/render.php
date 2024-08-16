<?php

/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$context = array( 'images' => $attributes['images'] );

?>

<div class="wp-block-event-gallery has-event-gallery-images-<?php echo count( $attributes['images'] ); ?>">
	<?php
	foreach ( array_chunk( $attributes['images'], 1, true ) as $images ) :
		?>
			<?php
			foreach ( $images as $key => $image ) :
				?>
			<figure data-wp-key="<?php echo esc_attr( $image['id'] ); ?>" class="wp-block-event-gallery-item"
				data-wp-interactive="laao/event-gallery"
				<?php
				echo wp_kses_data(
					wp_interactivity_data_wp_context(
						laao_render_event_gallery_context( $image, $key ),
					)
				);
				?>
				>
				<?php
				echo wp_get_attachment_image(
					$image['id'],
					'large',
					'',
					array(
						'class'                   => 'wp-block-event-gallery-item-image',
						'loading'                 => 'lazy',
						'data-id'                 => $image['id'],
						'data-wp-key'             => $image['id'],
						'data-wp-on-async--click' => 'actions.showLightbox',
						'data-wp-on-async--load'  => 'callbacks.setOverlayStyles',
						'data-wp-init'            => 'callbacks.init',
					),
				);
				?>
			</figure>
			<?php endforeach; ?>
	<?php endforeach; ?>
</div>
