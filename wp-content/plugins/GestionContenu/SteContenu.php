<?php
/**
 * @package Steclient
 */
/*
Plugin Name: SteGestionContenu
Description: Module de Gestion du contenu
Version: 1.0.0
Author: AHSINA Wassim
Text Domain: SteGestionContenu
*/

add_action( 'admin_head', 'getion_contenu_Header_content' );
function getion_contenu_Header_content() {
?>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/dark-hive/jquery-ui.css" id="theme">
<!--[if lte IE 8]>
<link rel="stylesheet" href="css/demo-ie8.css">
<![endif]-->
<style>
/* Adjust the jQuery UI widget font-size: */
.ui-widget {
    font-size: 0.95em;
}
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<?php
}
add_action('admin_menu','steContenu_admin_actions');
function steContenu_admin_actions(){
	wp_enqueue_style('CssDemo', plugins_url('css/style.css',__FILE__), array(), '2', true );
	wp_enqueue_script('JSiframetransport', plugins_url('js/script.js',__FILE__), array(), '2', true );
	add_submenu_page('edit.php?post_type=page', 'Gestion d\'accueil', 'Page d\'accueil', 'manage_options', __FILE__ .'_Accueil', 'Gestion_Accueil_SubMenu');
	}
	
function Gestion_Accueil_SubMenu(){
	include 'GestionAccueil.php';
}

?>
