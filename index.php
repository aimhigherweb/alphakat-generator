<?php
   /*
   Plugin Name: Alphakat Art Creator
   */

// Add extra function files
  require_once(__DIR__ . '/functions/letters.php');
  require_once(__DIR__ . '/functions/product.php');
  require_once(__DIR__ . '/functions/product_details.php');
  require_once(__DIR__ . '/functions/prices.php');

  // Register and load widget
	function alphakat_load_widget() {
		register_widget('alphakat_creator');
	}
	add_action('widgets_init', 'alphakat_load_widget');
	
// Create the Widget
	class alphakat_creator extends WP_Widget {
		function __construct() {
			parent::__construct(
				'alphakat_widget',
				'Alphakat Art Creator'
			);

			add_action('widgets_init', function() {
				register_widget('alphakat_creator');
			});
		}

		public $args = array(
			'before_title' => ''
		);

		public function widget($args, $instance) {
			include( plugin_dir_path( __FILE__ ) . 'includes/widget_layout.php');
		}
	}

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