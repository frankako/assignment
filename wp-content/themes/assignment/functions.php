<?php declare (strict_types = 1);

function css_js_files() {
	wp_enqueue_script("mainJs", get_theme_file_uri("/js/assets/script.js"));
	wp_enqueue_style("mainCss", get_stylesheet_uri());
}
add_action("wp_enqueue_scripts", "css_js_files");

function themeFeatures() {
	add_theme_support("title-tag");
}
add_action("after_setup_theme", "themeFeatures");

/**
 * Creating metabbox fields
 * @param  $meta_boxes custom field
 * @return object
 */
function assignment_metaboxes($meta_boxes) {
	$prefix = 'prefix-'; //could be used if desired

	$meta_boxes[] = array(
		'id' => 'assignment',
		'title' => esc_html__('Assignment Metaboxes', 'metabox-online-generator'),
		'post_types' => array('post'),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'true',
		'fields' => array(
			array(
				'id' => 'realease_date',
				'type' => 'datetime',
				'name' => esc_html__('Date Time Picker', 'metabox-online-generator'),
				'desc' => esc_html__('Date of Post', 'metabox-online-generator'),
				'timestamp' => 'true',
				'inline' => 'true',
				'size' => 30,
			),

			array(
				'id' => 'contact_details',
				'name' => esc_html__('Contact Details'),
				'type' => 'fieldset_text',

				// Options: array of key => Label for text boxes
				// Note: key is used as key of array of values stored in the database
				'options' => array(
					'name' => 'Name',
					'email' => 'Email',
					'phone' => 'Phone Number',
				),

				// Is field cloneable?
				'clone' => true,
				'attributes' => array(
					'required' => true,
					'minlength' => 3,
				),
			),
		),
	);
	return $meta_boxes;
}
add_filter('rwmb_meta_boxes', 'assignment_metaboxes');

?>