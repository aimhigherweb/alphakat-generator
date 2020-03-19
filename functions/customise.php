<?php

// Add custom panel for colours and fonts
function alphakat_customize_register( $wp_customize ) {
	$wp_customize->add_panel( 'alphakat_custom_styles', array(
		'title' => __( 'Alphakat' ),
		'description' => '<p>Custom styling for Alphakat custom module</p>', // Include html tags such as <p>.
		'priority' => 160, // Mixed with top-level-section hierarchy.
	) );

	// $wp_customize->add_section( 'alphakat-styles' , array(
	// 	'title' => 'Custom Styles',
	// 	'priority' => 105, // Before Widgets.
	// ) );

	$wp_customize->add_setting( 'alphakat_style_options[primary]', array(
		'type' => 'option',
		'capability' => 'manage_options',
		'default' => '#FAA862',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
 }
 add_action( 'customize_register', 'alphakat_customize_register' );


	

?>