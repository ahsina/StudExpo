<?php
/**
 * @package Steclient
 */
/*
Plugin Name: Steclient
Description: Module de Gestion des clients de StudExpo
Version: 1.0.0
Author: AHSINA Wassim
Text Domain: Steclient
*/

add_action( 'admin_head', 'my_header_content' );
function my_header_content() {
?>
	<link href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href="http://www.datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	
<?php
}
include 'Home.php';
include 'CommonFunction.php';
add_action('admin_menu','steExposant_admin_actions');
function steExposant_admin_actions(){
	add_menu_page('Gestion des clients','Gestion des clients','manage_options',__FILE__,'getHomePageClients','', 6 ); 
	wp_enqueue_script('utils_js', plugins_url('/JS/utils.js',__FILE__) );
	wp_enqueue_script('TableToolsJquery', plugins_url('JS/DataTables-1.10.5/media/js/jquery.js',__FILE__), array(), '2', true );
	wp_enqueue_script('DataTables_js',plugins_url('JS/DataTables-1.10.5/media/js/jquery.dataTables.min.js',__FILE__) , array(), '1', true);
	//wp_enqueue_script('ZeroClip_js',plugins_url('JS/TableTools/media/ZeroClipboard/ZeroClipboard.js',__FILE__) , array(), '1', true);
	wp_enqueue_script('TableTools_js', plugins_url('JS/DataTables-1.10.5/extensions/TableTools/js/dataTables.tableTools.min.js',__FILE__), array(), '1', true );
	add_submenu_page(__FILE__, 'Visiteurs', 'Visiteurs', 'manage_options', __FILE__ .'_Visiteurs', 'visiteurs_SubMenu');
	add_submenu_page(__FILE__, 'Exposants', 'Exposants', 'manage_options', __FILE__ .'_Exposants', 'exposants_SubMenu');
	add_submenu_page(__FILE__, 'Concours', 'Concours', 'manage_options', __FILE__ .'_Concours', 'Concours_Utilisateurs_SubMenu');
	}
	
function visiteurs_SubMenu(){
		include 'Visiteurs/ListOfVisiteurs.php';
		getListOfVisiteursSTE();

}

function exposants_SubMenu(){
	include 'Exposants/ListOfExposants.php';
	getListOfExposantsSTE();
}

function Concours_Utilisateurs_SubMenu(){
	include 'User_Concours/ListOfUserConcours.php';
	getListOfUserConcoursSTE();
}

?>
