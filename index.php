<?php
   /*
   Plugin Name: Alphakat Art Creator
   */

// Add extra function files
  require_once(__DIR__ . '/functions/letters.php');
  require_once(__DIR__ . '/functions/product.php');
  require_once(__DIR__ . '/functions/product_details.php');
  require_once(__DIR__ . '/functions/prices.php');
  require_once(__DIR__ . '/functions/customise.php');

  //Create Shortcode
  function alphakat_shortcode() {
	ob_start();

	include( plugin_dir_path( __FILE__ ) . 'includes/widget_layout.php');

	$content = ob_get_clean();

	return $content;
  }

  add_shortcode('alphakat_generator', 'alphakat_shortcode');

// Add scripts
	function add_scripts() {
		wp_register_script('letter_script', plugins_url('scripts/letters.js', __FILE__));

		wp_enqueue_script('letter_script');
	}

	add_action('wp_enqueue_scripts', 'add_scripts');

// Add Styles
	wp_enqueue_style( 'alphakat_generator', plugins_url('styles/style.css', __FILE__));

	function admin_style() {
		wp_enqueue_style('admin-styles', plugins_url('styles/admin.css', __FILE__));
	}
	add_action('admin_enqueue_scripts', 'admin_style');
	add_action('acf/input/admin_head', 'admin_style');
?>