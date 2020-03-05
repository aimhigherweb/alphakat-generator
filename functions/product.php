<?php 		


	add_action( 'admin_post_add_art', 'prefix_admin_add_art' );
	add_action( 'admin_post_nopriv_add_art', 'prefix_admin_add_art' );

	function prefix_admin_add_art() {
		if(isset($_POST['letters'])) {
			$text = $_POST['text'];
			$letters = $_POST['letters'];
			$board = $_POST['board'];
			$colour = $_POST['colour'];

			global $current_user;

			if (is_user_logged_in()) {
				$user_id = $current_user->ID;
			} else {
				$user_id = 1;
			}

			$new_product = array(
				'post_title' => strtoupper($_POST['text']),
				'post_content' => '',
				'post_status' => 'publish',
				'post_author' => $user_id,
				'post_type' => 'product',
			);

			$post_id = wp_insert_post($new_product);
			$term = '15';
			$taxonomy = 'product_cat';
			wp_set_post_terms($post_id, $term, $taxonomy);
			$price = get_field(count($letters), 'option');



			update_post_meta($post_id, '_price', $price);
			update_post_meta($post_id, '_regular_price', $price);

			update_post_meta($post_id, 'my_pr_color', $colour);
			update_post_meta($post_id, 'my_pr_background', $board);
			update_post_meta($post_id, 'my_pr_image', json_encode($letters));

			update_post_meta($post_id, '_manage_stock', 'no');
			update_post_meta($post_id, '_backorders', 'no');
			update_post_meta($post_id, '_featured', 'no');
			update_post_meta($post_id, '_virtual', 'no');
			update_post_meta($post_id, '_downloadable', 'no');
			update_post_meta($post_id, 'total_sales', '0');
			update_post_meta($post_id, '_stock_status', 'instock');
			update_post_meta($post_id, '_visibility', 'visible');
			update_post_meta($post_id, '_stock', '10');
			update_post_meta($post_id, '_sold_individually', '');
			update_post_meta($post_id, '_sale_price_dates_to', '');
			update_post_meta($post_id, '_sale_price_dates_from', '');
			update_post_meta($post_id, '_product_attributes', '');
			update_post_meta($post_id, '_sku', '');
			update_post_meta($post_id, '_height', '');
			update_post_meta($post_id, '_width', '');
			update_post_meta($post_id, '_length', '');
			update_post_meta($post_id, '_weight', '');
			update_post_meta($post_id, '_purchase_note', '');
			update_post_meta($post_id, '_tax_class', '');
			update_post_meta($post_id, '_tax_status', '');
			update_post_meta($post_id, '_sale_price', '');
			update_post_meta($post_id, '_product_image_gallery', '');
			update_post_meta($post_id, '_thumbnail_id', '');

			$permalink = get_permalink($post_id);
			wp_redirect('/?add-to-cart=' . $post_id);
			exit;
		}
	}

	
?>