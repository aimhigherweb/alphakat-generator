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
			

			switch(count($letters)) {
				case 1:
				case 2:
				case 3:
					$price = the_field('3', 'option');
				break;
				case 4:
					$price = get_option('font_price_2');
				break;
				case 5:
					$price = get_option('font_price_3');
				break;
				case 6:
					$price = get_option('font_price_4');
				break;
				case 7:
					$price = get_option('font_price_5');
				break;
				case 8:
					$price = get_option('font_price_6');
				break;
				case 9:
					$price = get_option('font_price_7');
				break;
			}

			echo '<br/>price';
			echo $price;
			echo '<br/>letters';
			echo count($letters);
			echo '<br/>post letters';
			echo count($_POST['letters']);
			echo '<br/>dump letters';
			var_dump($letters);


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
			// wp_redirect($permalink);
			// exit;
		}
	}

	
?>