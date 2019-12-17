<?php declare (strict_types = 1);

/**
 *Plugin Name: Assignment Meta Plugin
 *Description: Custom Assignment Meta Plugin
 * Version: 1.0
 * Author: Frank Ako
 */

function register_custom_meta_boxes() {
	add_meta_box("09meta", "Custom Meta Box", "custom_meta_callback", "page", "advanced", "default");
}
add_action("add_meta_boxes", "register_custom_meta_boxes");

function custom_meta_callback($post) {
	wp_nonce_field(basename(__FILE__), "custom_meta_nonce");
	$post_id = $post->ID;
	$metaData = get_post_meta($post_id, "custom_meta", true);
	?>
        <label for="release_date">Date</label>
        <input type="datetime-local" class="form-control" name="release_date">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="<?php if (isset($metaData['name'])) {
		echo $metaData["name"];
	}
	?>">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?php if (isset($metaData['name'])) {
		echo $metaData["email"];
	}
	?>">
        <label for="tel">Phone</label>
        <input type="tel" class="form-control" name="tel" value="<?php if (isset($metaData['name'])) {
		echo $metaData["tel"];
	}
	?>">

  <?php
}

function save_custom_meta_fields($post_id, $post) {
	if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['tel']) || !isset($_POST['release_date']) || !wp_verify_nonce($post['nonce'], basename(__FILE__))) {
		return $post_id;
	}

	if ($post->post_type !== "post") {
		return $post_id;
	}

	if (isset($_POST['name']) AND isset($_POST['email']) AND isset($_POST['tel']) && isset($_POST['release_date'])) {

		$name = sanitize_text_field($_POST['name']);
		$email = sanitize_text_field($_POST['email']);
		$release_date = sanitize_text_field($_POST['release_date']);
		$tel = sanitize_text_field($_POST['tel']);

	} else {
		$name = "";
		$email = "";
		$realease_date = "";
		$tel = "";
	}

	$data = array(
		"name" => $name,
		"email" => $email,
		"release_date" => $release_date,
		"tel" => $tel,
	);
	var_dump($data);

	update_post_meta($post_id, "custom_meta", serialize($data));
}
add_action("save_post", "save_custom_meta_fields", 10, 2);