<?php
	function DeleteVisiteur(){
		if(!empty($_POST['idUserConcours'])){
			$UsersToDelete = explode("/", preg_replace('/\s+/', '', $_POST['idUserConcours']));
			global $wpdb;
			foreach ($UsersToDelete as $u){ 
			$wpdb->delete( 'ste_UserConcours', array( 'id' => $u));
			}
			///Notify: user succesfully deleted
		}
	}
	DeleteVisiteur();
?>