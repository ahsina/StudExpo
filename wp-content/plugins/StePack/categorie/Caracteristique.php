<?php
function addnewCaracteristique(){
	if (empty($_POST['idCaM'])) {
		if(!empty($_POST['caracteristiqueLabel']) && !empty($_POST['listofcategorie'])){
			$NUcaracteristiqueLabel = $_POST['caracteristiqueLabel'];
			$NUlistofcategorie = $_POST['listofcategorie'];
			$NUPrix = $_POST['caracteristiquePrix'];
			$_SESSION['listofcategorie']=$_POST['listofcategorie'];
			global $wpdb;
			$wpdb->insert( 
			'ste_caracteristique', 
			array('id' => NULL,'libelle' => $NUcaracteristiqueLabel,'prix' => $NUPrix, 'idcategorie' =>$NUlistofcategorie)
			);
			//Notify Caracteristique Added
		}
	}
}
function getCaracteristiqueInfo($id){
	global $wpdb;
		$Caracteristique = $wpdb->get_results(
		"SELECT id,libelle,prix,idcategorie
		FROM ste_caracteristique where id=".$id);

		$_SESSION['ID']=$id;
		$_SESSION['MUlibelle']=$Caracteristique[0]->libelle;
		$_SESSION['MUprix']=$Caracteristique[0]->prix;
		$_SESSION['MUcategorie']=$Caracteristique[0]->idcategorie;
		//$_SESSION['listofcategorie']=$Caracteristique[0]->idcategorie;

}

function ModifyCaracteristique(){
	if (!empty($_POST['idCaM'])) {
		if(!empty($_POST['caracteristiqueLabel']) && !empty($_POST['listofcategorie'])){
			$_SESSION['listofcategorie']=$_POST['listofcategorie'];
			global $wpdb;
			$result=$wpdb->update( 
				'ste_caracteristique', 
				array('libelle' => $_POST['caracteristiqueLabel'], 'prix' =>$_POST['caracteristiquePrix'],
			'idcategorie' => $_POST['listofcategorie']),array( 'id' => $_POST['idCaM'])
			);
			///Notify: Caracteristique succesfully Modified
		}
	}
}

function DeleteCaracteristique(){
	if(!empty($_POST['idCaracteristiques'])){
			$CaracteristiquesToDelete = explode("/", preg_replace('/\s+/', '', $_POST['idCaracteristiques']));
			global $wpdb;
			foreach ($CaracteristiquesToDelete as $u){ 
			$wpdb->delete( 'ste_caracteristique', array( 'id' => $u));
			}
			///Notify: user succesfully deleted
		}
}
function getCaracteristiqueID(){
	echo $_SESSION['ID'];
}
function getCaracteristiqueLibelle(){
	echo $_SESSION['MUlibelle'];
}
function getCaracteristiquePrix(){
	echo $_SESSION['MUprix'];
}
function getCaracteristiqueCategorie(){
	echo $_SESSION['MUcategorie'];
}
?>