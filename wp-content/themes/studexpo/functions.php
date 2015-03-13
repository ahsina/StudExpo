<?php



function studexpo_scripts () {
	wp_enqueue_style('studexpo_style_global', get_stylesheet_uri().'less/styles.css');

}

add_action('wp_enqueue_scripts', 'studexpo_scripts');
?>