<?php
/**
 * @package StePack
 */
/*
Plugin Name: StePack
Description: Module de Gestion des Packs de StudExpo
Version: 1.0.0
Author: AHSINA Wassim
Text Domain: StePack
*/

add_action( 'admin_head', 'header_Pack_content' );
function header_Pack_content() {
?>
	<link href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href="http://www.datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	
<?php
}
require_once 'HomePack.php';
add_action('admin_menu','stePacks_admin_actions');
function stePacks_admin_actions(){
	add_menu_page('Pack studExpo','Pack studExpo','manage_options',__FILE__,'getHomePackManagement','', 7 ); 
	wp_enqueue_script('utils_js', plugins_url('/JS/utils.js',__FILE__) );
	wp_enqueue_script('TableToolsJquery', plugins_url('JS/DataTables-1.10.5/media/js/jquery.js',__FILE__), array(), '2', true );
	wp_enqueue_script('DataTables_js',plugins_url('JS/DataTables-1.10.5/media/js/jquery.dataTables.min.js',__FILE__) , array(), '1', true);
	//wp_enqueue_script('ZeroClip_js',plugins_url('JS/TableTools/media/ZeroClipboard/ZeroClipboard.js',__FILE__) , array(), '1', true);
	wp_enqueue_script('TableTools_js', plugins_url('JS/DataTables-1.10.5/extensions/TableTools/js/dataTables.tableTools.min.js',__FILE__), array(), '1', true );
	add_submenu_page(__FILE__, 'Gestion des packs', 'Gestion des packs', 'manage_options', __FILE__ .'_Pack', 'Pack_SubMenu');
	add_submenu_page(__FILE__, 'Gestion des categories', 'Gestion des categories', 'manage_options', __FILE__ .'_Categorie', 'Categorie_SubMenu');

	}
	
function Pack_SubMenu(){
		include 'Pack/ListOfPacks.php';
		getListOfPackSTE();

}

function Categorie_SubMenu(){
	include 'categorie/ListOfCategorie.php';
	getListOfCaracteristiqueSTE();
}


?>
