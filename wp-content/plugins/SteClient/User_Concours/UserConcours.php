<?php 	
	function AddNewUserConcours(){
		if (empty($_POST['idV'])) {

			$NUcivilite = $_POST['ListCivilites'];
			$NUnom = $_POST['nom'];
			$NUprenom = $_POST['prenom'];
			$NUnumAsso = $_POST['numAsso'];
			$NUemail=$_POST['email'];
			$NUville=$_POST['ville'];
			$NUtel = $_POST['tel'];
			$NUadresse = $_POST['adresse'];
			$NUcodePostal = $_POST['codePostal'];
			$NULibelleEcole = $_POST['LibelleEcole'];
			$NULibelleAsso = $_POST['LibelleAsso'];
			$NUNbEtudiantEcole = $_POST['NbEtudiantEcole'];
			$NUNbPersonneAsso = $_POST['NbEtudiantEcole'];
					
			if(!empty($NUcivilite) && !empty($NUnom) && !empty($NUprenom)&& !empty($NUnumAsso)&& !empty($NUemail) 
			&& !empty($NUville) && !empty($NUtel)&& !empty($NUadresse) && !empty($NUcodePostal)&& !empty($NULibelleEcole) && !empty($NULibelleAsso) 
			&& !empty($NUNbEtudiantEcole) && !empty($NUNbPersonneAsso) ){
				
				global $wpdb;
				$resut=$wpdb->insert( 
				'ste_UserConcours', 
				array('id' => NULL,'civilite' => $NUcivilite,'nom' => $NUnom, 'prenom' =>$NUprenom,'numAsso' => $NUnumAsso,
				'email' => $NUemail, 'ville' => $NUville, 'Tel' => $NUtel,'Adresse'=>$NUadresse,'CodePostal'=>$NUcodePostal,
				'LibelleEcole' => $NULibelleEcole,'LibelleAsso' => $NULibelleAsso,'NbEtudiantEcole' => $NUNbEtudiantEcole,
				'NbPersonneAsso' => $NUNbPersonneAsso)
				);
				///Notify: user succesfully Added
			}

		}
	
	}
		
	function getVisiteurNom(){
		echo $_SESSION['MUnom'];
	}
	function getVisiteurPrenom(){
		echo $_SESSION['MUprenom'];
	}
	function getVisiteurnumAsso(){
		echo $_SESSION['MUnumAsso'];
	}
	function getVisiteurEmail(){
		echo $_SESSION['MUemail'];
	}
	function getVisiteurVilles(){
		echo $_SESSION['MUville'];
	}
	function getVisiteurTel(){
		echo $_SESSION['MUtel'];
	}
	function getVisiteurAdresse(){
		echo $_SESSION['MUadresse'];
	}
	function getVisiteurCodePostal(){
		echo $_SESSION['MUcodePostal'];
	}
	function getVisiteurLibelleEcole(){
		echo $_SESSION['MULibelleEcole'];
	}
	function getVisiteurLibelleAsso(){
		echo $_SESSION['MULibelleAsso'];
	}
	function getVisiteurNbEtudiantEcole(){
		echo $_SESSION['MUNbEtudiantEcole'];
	}
	function getVisiteurNbPersonneAsso(){
		echo $_SESSION['MUNbPersonneAsso'];
	}
	
if (!empty($_POST['idUserConcour'])) {
	$idUserConcour=$_POST['idUserConcour'];
	getUserConcoursInfo($idUserConcour);
}
	
?>

<?php
	
function getUserConcoursInfo($id){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT cl.civilite,cl.id,cl.nom,cl.prenom,cl.NumAsso,cl.email,cl.Tel,cl.Ville,cl.Adresse,cl.CodePostal,cl.LibelleEcole,cl.LibelleAsso,cl.NbEtudiantEcole,cl.NbPersonneAsso
		FROM ste_UserConcours cl where id=".$id);

		$_SESSION['ID']=$id;
		$_SESSION['MUcivilite']=$user[0]->civilite;
		$_SESSION['MUnom']=$user[0]->nom;
		$_SESSION['MUprenom']=$user[0]->prenom;
		$_SESSION['MUnumAsso']=$user[0]->NumAsso;
		$_SESSION['MUemail']=$user[0]->email;
		$_SESSION['MUville']=$user[0]->Ville;
		$_SESSION['MUtel']=$user[0]->Tel;
		$_SESSION['MUadresse']=$user[0]->Adresse;
		$_SESSION['MUcodePostal']=$user[0]->CodePostal;
		$_SESSION['MULibelleEcole']=$user[0]->LibelleEcole;
		$_SESSION['MULibelleAsso']=$user[0]->LibelleAsso;
		$_SESSION['MUNbEtudiantEcole']=$user[0]->NbEtudiantEcole;
		$_SESSION['MUNbPersonneAsso']=$user[0]->NbPersonneAsso;
		
		
}
function UpdateUserConcoursInfo(){
	if (!empty($_POST['idV'])) {
		$ExidUserconcour =$_POST['idV'];
		$Excivilite = $_POST['ListCivilites'];
		$Exnom = $_POST['nom'];
		$Exprenom = $_POST['prenom'];
		$ExnumAsso = $_POST['numAsso'];
		$Exemail=$_POST['email'];
		$Exville=$_POST['ville'];
		$Extel = $_POST['tel'];
		$Exadresse = $_POST['adresse'];
		$ExcodePostal = $_POST['codePostal'];
		$ExLibelleEcole = $_POST['LibelleEcole'];
		$ExLibelleAsso = $_POST['LibelleAsso'];
		$ExNbEtudiantEcole = $_POST['NbEtudiantEcole'];
		$ExNbPersonneAsso = $_POST['NbPersonneAsso'];

		if(!empty($Excivilite) && !empty($Exnom) && !empty($Exprenom)&& !empty($ExnumAsso) && !empty($Exemail) &&
		!empty($Exville) && !empty($Extel)&& !empty($Exadresse)&& !empty($ExcodePostal)&& !empty($ExLibelleEcole) 
		&& !empty($ExLibelleAsso) && !empty($ExNbEtudiantEcole) && !empty($ExNbEtudiantEcole) && !empty($ExNbPersonneAsso) ){
			
			global $wpdb;
			$result=$wpdb->update( 
				'ste_UserConcours', 
				array('civilite' => $Excivilite,'nom' => $Exnom, 'prenom' =>$Exprenom,
			'numAsso' => $ExnumAsso, 'email' => $Exemail, 'ville' => $Exville,
			'Tel' => $Extel,'adresse' =>$Exadresse,'codepostal' =>$ExcodePostal,
			'LibelleEcole' => $ExLibelleEcole,'LibelleAsso' => $ExLibelleAsso,'NbEtudiantEcole' => $ExNbEtudiantEcole,
			'NbPersonneAsso' => $ExNbPersonneAsso,)
			,array( 'id' => $ExidUserconcour)
			);
		}
		
		//reactualiser les données de l'utilisateur
		$_SESSION['MUcivilite']=$ExidUserconcour;
		$_SESSION['MUnom']=$Exnom;
		$_SESSION['MUprenom']=$Exprenom;
		$_SESSION['MUnumAsso']=$ExnumAsso;
		$_SESSION['MUemail']=$Exemail;
		$_SESSION['MUville']=$Exville;
		$_SESSION['MUtel']=$Extel;
		$_SESSION['MUadresse']=$Exadresse;
		$_SESSION['MUcodePostal']=$ExcodePostal;
		$_SESSION['MULibelleEcole']=$ExLibelleEcole;
		$_SESSION['MULibelleAsso']=$ExLibelleAsso;
		$_SESSION['MUNbEtudiantEcole']=$ExNbEtudiantEcole;
		$_SESSION['MUNbPersonneAsso']=$ExNbPersonneAsso;
		///Notify: user succesfully updated
	}
}
UpdateUserConcoursInfo();
AddNewUserConcours();
?>
<form method="post" name="Modify-Visiteur">
<div class="wrap">
	<input type="hidden" name="idV" value="<?php if(!empty($idUserConcour)){ echo $idUserConcour;};?>"/>
	<div style="width:100%">
		<label>Nom de l'école</label>
		<input type="text" name="LibelleEcole" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurLibelleEcole();
						}?>"/>
						
		<label>Nombre d'etudiant de l'ecole</label>
		<input type="text" name="NbEtudiantEcole" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurNbEtudiantEcole();
						}?>"/>
	</div>
	<div>
		<label>Nom de l'asso</label>
		<input type="text" name="LibelleAsso" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurLibelleAsso(); 
						}?>"/>
		<label>N° de l'asso</label>
		<input type="text" name="numAsso" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurNumAsso(); 
						}?>"/>
						
		<label>Nombre de personne affilié</label>
		<input type="text" name="NbPersonneAsso" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurNbPersonneAsso();
						}?>"/>	
	</div>
	<div>

		<label>Civilite</label>
		<?php if(!empty($idUserConcour)){
		getListCivilites($_SESSION['MUcivilite']); 
		}
		else{
		getListCivilites(null);
		}?>
	</div>
	
	<div style="width:100%">
		<label>Nom</label>
		<input type="text" name="nom" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurNom();
						}?>"/>

		<label>Pr&eacute;nom</label>
		<input type="text" name="prenom" 
		value="<?php if(!empty($idUserConcour)){
						getVisiteurPrenom(); 
						}?>"/>
	</div>
	
	<div>
		<label>Email</label>
		<input type="text" name="email" 
			value="<?php if(!empty($idUserConcour)){
							getVisiteurEmail(); 
							}?>"/>
							
		<label>Tel</label>
		<input type="text" name="tel" 
			value="<?php if(!empty($idUserConcour)){
							getVisiteurtel();
							} ?>"/>			
	</div>
	<div style="width:100%">
	<label>Adresse</label>
		<input type="text" name="adresse" 
			value="<?php if(!empty($idUserConcour)){
							getVisiteurAdresse();
							} ?>"/>
		<label>Ville</label>
		<input type="text" name="ville" 
			value="<?php if(!empty($idUserConcour)){
							getVisiteurVilles();
							} ?>"/>
	</div>
	<div>
		<label>codePostal</label>
		<input type="text" name="codePostal" 
			value="<?php if(!empty($idUserConcour)){
							getVisiteurCodePostal();
							} ?>"/>
	</div>
	
<div class="wrap">
<input type="submit" value="Enregistrer" name="user-update" class="button-primary"/>
<a href="#" class="button-secondary"> Annuler</a>
</div>
</form>