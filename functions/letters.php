<?php

//Custom post type for letters
function create_post_type() {
	register_post_type('letters',
		array(
			'labels' => array(
				'name' => _('Letters'),
				'singular_name' => _('Letter'),
			),
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-editor-textcolor',
			'publicly_queryable' => true,
			'public' => true,
			'exclude_from_search' => true
		)
	);
}
add_action('init', 'create_post_type');

/*
* Disable Gutenberg for Custom Letter Post Type
*/

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type) {
	if ($post_type === 'letters') return false;
	return $current_status;
}

// Add Custom Fields to add Letter images
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5dd4ff4d79e0c',
		'title' => 'Add Letters',
		'fields' => array(
			array(
				'key' => 'field_5e606a9405d8f',
				'label' => 'Letters',
				'name' => 'letters',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'insert' => 'append',
				'library' => 'all',
				'min' => '',
				'max' => '',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'letters',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'the_content',
			1 => 'excerpt',
			2 => 'discussion',
			3 => 'comments',
			4 => 'author',
			5 => 'format',
			6 => 'featured_image',
			7 => 'categories',
			8 => 'tags',
			9 => 'send-trackbacks',
		),
		'active' => true,
		'description' => '',
	));
	
	endif;

?>