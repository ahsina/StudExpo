<?php
add_action('wp_enqueue_scripts','StudExpo_Style');
function StudExpo_Style(){
	echo '<script>alert("'.get_template_directory().'");</script>';
	wp_enqueue_script('mainStyle', get_template_directory().'/mystyle.css' );
}
?>