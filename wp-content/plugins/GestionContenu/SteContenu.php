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
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"/>;
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"/>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js" />
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<?php
}
add_action('admin_menu','steContenu_admin_actions');
function steContenu_admin_actions(){
wp_enqueue_style('CssDemo', plugins_url('css/demo.css',__FILE__), array(), '2', true );
	wp_enqueue_style('Cssfileupload', plugins_url('css/jquery.fileupload.css',__FILE__), array(), '2', true );
	wp_enqueue_style('CssfileuploadUI', plugins_url('css/jquery.fileupload-ui.css',__FILE__), array(), '2', true );
	wp_enqueue_script('JSiframetransport', plugins_url('js/jquery.iframe-transport.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileupload', plugins_url('js/jquery.fileupload.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadProcess', plugins_url('js/jquery.fileupload-process.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadImage', plugins_url('js/jquery.fileupload-image.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadAudio', plugins_url('js/jquery.fileupload-audio.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadVideo', plugins_url('js/jquery.fileupload-video.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadValidate', plugins_url('js/jquery.fileupload-validate.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadUI', plugins_url('js/jquery.fileupload-ui.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadJquery', plugins_url('js/jquery.fileupload-jquery-ui.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSMain', plugins_url('js/main.js',__FILE__), array(), '2', true );
	add_submenu_page('edit.php?post_type=page', 'Gestion d\'accueil', 'Page d\'accueil', 'manage_options', __FILE__ .'_Accueil', 'Gestion_Accueil_SubMenu');
	}
	
function Gestion_Accueil_SubMenu(){
	include 'GestionAccueil.php';
}

?>
