<?php
	function DeleteExposant(){
		if(!empty($_POST['idExposants'])){
			$UsersToDelete = explode("/", preg_replace('/\s+/', '', $_POST['idExposants']));
			global $wpdb;
			foreach ($UsersToDelete as $u){ 
			$wpdb->delete( 'ste_exposants', array( 'id' => $u));
			}
			///Notify: user succesfully deleted
		}
	}
	DeleteExposant();
?>