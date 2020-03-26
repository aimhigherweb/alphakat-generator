<?php

$defaults = array(
	'primary' => '#FAA862',
	'secondary' => '#005e62',
	'font_feature' => "'Rhesmanisa',Helvetica, Arial, Lucida, sans-serif",
	'font_body' => "'Lato',Helvetica,Arial,Lucida,sans-serif",
);


// Add custom panel for colours and fonts
add_action('customize_register', 'alphakat_generator_customizer_settings');

function alphakat_generator_customizer_settings($wp_customize) {
	global $defaults;

	$wp_customize->add_section('alphakat_generator', array(
		'title' => 'Alphakat Generator',
		'priority' => 30,
	));

	//Primary Colour
	$wp_customize->add_setting('generator_primary_colour', array(
		'default' => $defaults['primary'],
		'transport' => 'refresh',
		'type' => 'option',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'generator_primary_colour',
		array (
			'label' => 'Primary Colour',
			'section' => 'alphakat_generator',
			'settings' => 'generator_primary_colour',
		)
	));

	// Secondary Colour
	$wp_customize->add_setting('generator_secondary_colour', array(
		'default' => $defaults['secondary'],
		'transport' => 'refresh',
		'type' => 'option',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'generator_secondary_colour',
		array (
			'label' => 'Secondary Colour',
			'section' => 'alphakat_generator',
			'settings' => 'generator_secondary_colour',
		)
	));

	// Background Image
	$wp_customize->add_setting('generator_background_image', array(
		'transport' => 'refresh',
		'type' => 'option',
	));


	$wp_customize->add_control(new WP_Customize_Media_Control( 
		$wp_customize,
		'image_control', 
		array(
			'label' => 'Background Image',
			'section' => 'alphakat_generator',
			'settings' => 'generator_background_image',
			'mime_type' => 'image',
		)
	));

	// Fonts
	$wp_customize->add_setting( 'alphakat_feature_font', array(
		'transport' => 'refresh',
		'type' => 'option',
		'default' => $defaults['font_feature'],
		)
	);

	$wp_customize->add_control( 'alphakat_feature_font', array(
			'type' => 'text',
			'description' => 'Select the feature font to be used in the generator (headings etc)',
			'section' => 'alphakat_generator',
		)
	);

	$wp_customize->add_setting( 'alphakat_body_font', array(
		'transport' => 'refresh',
		'type' => 'option',
		'default' => $defaults['font_body'],
		)
	);

	$wp_customize->add_control( 'alphakat_body_font', array(
			'type' => 'text',
			'description' => 'Select the desired font for the rest of the generator',
			'section' => 'alphakat_generator',
		)
	);
}
	
add_action('wp_head', 'alphakat_generator_customizer_css');

function alphakat_generator_customizer_css() {
	global $defaults;
	?>

		<style type="text/css">

			.alphakat_generator {
				--primary: <?php echo get_option('generator_primary_colour', $defaults['primary']); ?>;
				--secondary: <?php echo get_option('generator_secondary_colour', $defaults['secondary']); ?>;
				--module_background: url(<?php echo wp_get_attachment_image_src(get_option('generator_background_image'), 'full')[0]; ?>);
				--font_feature: <?php echo get_option('alphakat_feature_font', $defaults['font_feature']); ?>;
				--font_main: <?php echo get_option('alphakat_body_font', $defaults['font_body']); ?>;
			}
		
		</style>

	<?php
}

?>