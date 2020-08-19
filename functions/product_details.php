<?php
// Custom meta box for images
	add_action('add_meta_boxes', 'art_custom_box');

	function art_custom_box() {
		$screens = array('product');

		foreach ($screens as $screen) {

			add_meta_box('art_box', 'Letters Image', 'art_image', $screen, 'normal', 'high');
		}
	}
	
	function art_image($product) {
		$images = get_post_meta($product->ID, 'my_pr_image', true);
		$color = get_post_meta($product->ID, 'my_pr_color', true);
		$background = get_post_meta($product->ID, 'my_pr_background', true);
	
		$images_array = json_decode($images);

		if($images_array) :

			if($color == 'bw') {
				$color = 'Black and White';
			}
			else {
				$color = 'Colour';
			}

			echo '<dl class="art-product"><dt>Colour/Black and White</dt><dd>' . $color . '</dd><dt>Background</dt><dd>' . $background . '</dd></dl>';
			echo '<div class="art-product-image">';
				foreach ($images_array as $image_id) {
			
					$image_attributes = wp_get_attachment_image_src($image_id, 'alphakat_letter');
					$attachment = get_post($image_id);
					echo '<figure><img src="' . $image_attributes[0] . '" class="my_image" /><figcaption>' . $attachment->post_title . '</figcaption></figure>';
				}
			echo '</div>';

		endif;
	}

?>