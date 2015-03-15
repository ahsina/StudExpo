<?php
	function DeleteExposant(){
		if(!empty($_POST['idCaracteristiques'])){
			$CaracteristiquesToDelete = explode("/", preg_replace('/\s+/', '', $_POST['idCaracteristiques']));
			global $wpdb;
			foreach ($CaracteristiquesToDelete as $u){ 
			$wpdb->delete( 'ste_caracteristique', array( 'id' => $u));
			}
			///Notify: user succesfully deleted
		}
	}
?>