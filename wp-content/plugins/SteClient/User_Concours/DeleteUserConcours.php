<?php
	function DeleteVisiteur(){
		if(!empty($_POST['idVisiteurs'])){
			$UsersToDelete = explode("/", preg_replace('/\s+/', '', $_POST['idVisiteurs']));
			global $wpdb;
			foreach ($UsersToDelete as $u){ 
			$wpdb->delete( 'ste_Visiteurs', array( 'id' => $u));
			}
			///Notify: user succesfully deleted
		}
	}
	DeleteVisiteur();
?>