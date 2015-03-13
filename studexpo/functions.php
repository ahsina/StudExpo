<?php

add_action('wp_enqueue_scripts', 'studexpo_scripts');

function studexpo_scripts () {
	wp_enqueue_style ('studexpo_style_global',get_template_directory_uri().'/style.css', array(), '1.0.0', true);

}
?>