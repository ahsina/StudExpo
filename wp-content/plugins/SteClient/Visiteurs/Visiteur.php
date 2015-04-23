<?php 	
	function addNewVisteur(){
		if (empty($_POST['idV'])) {
			$NUcivilite = $_POST['ListCivilites'];
			$NUnom = $_POST['nom'];
			$NUprenom = $_POST['prenom'];
			$NUnomAsso = $_POST['nomAsso'];
			$NUnumAsso = $_POST['numAsso'];
			$NUemail=$_POST['email'];
			$NUville=$_POST['ville'];
			$NUtel = $_POST['tel'];
			$NUadresse = $_POST['adresse'];
			$NUcodePostal = $_POST['codePostal'];
			$Password = EncryptPassword("test");
			
			if(!empty($NUcivilite) && !empty($NUnom) && !empty($NUprenom) && !empty($NUnomAsso) 
			&& !empty($NUnumAsso) && !empty($NUemail) && !empty($NUville) && !empty($NUtel)&& !empty($NUadresse) && !empty($NUcodePostal)){

				global $wpdb;
				$resut=$wpdb->insert( 
				'ste_visiteurs', 
				array('id' => NULL,'civilite' => $NUcivilite,'nom' => $NUnom, 'prenom' =>$NUprenom,
				'nomAsso' => $NUnomAsso, 'numAsso' => $NUnumAsso, 'ville' => $NUville, 'Tel' => $NUtel,'Adresse'=>$NUadresse
				,'CodePostal'=>$NUcodePostal)
				);
				$wpdb->insert( 
					'ste_connexion', 
					array('id' => NULL, 'email' => $NUemail,'password' => $Password,'role'=>1,'userid'=>$wpdb->insert_id)
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
	function getVisiteurnomAsso(){
		echo $_SESSION['MUnomAsso'];
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
	
if (!empty($_POST['idVisiteur'])) {
	$idVisiteur=$_POST['idVisiteur'];
	getVisiteurInfo($idVisiteur);
}
	
?>

<?php
	
function getVisiteurInfo($id){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT v.id,v.civilite,v.nom,v.prenom,v.nomAsso,v.numAsso,v.ville,v.tel,v.adresse,v.codepostal,c.email
		FROM ste_visiteurs v, ste_connexion c where v.id=".$id." and v.id=c.userid and c.role=1");

		$_SESSION['ID']=$id;
		$_SESSION['MUcivilite']=$user[0]->civilite;
		$_SESSION['MUnom']=$user[0]->nom;
		$_SESSION['MUprenom']=$user[0]->prenom;
		$_SESSION['MUnomAsso']=$user[0]->nomAsso;
		$_SESSION['MUnumAsso']=$user[0]->numAsso;
		$_SESSION['MUemail']=$user[0]->email;
		$_SESSION['MUville']=$user[0]->ville;
		$_SESSION['MUtel']=$user[0]->tel;
		$_SESSION['MUadresse']=$user[0]->adresse;
		$_SESSION['MUcodePostal']=$user[0]->codepostal;
		
		
}
function UpdateVisiteurInfo(){
	if (!empty($_POST['idV'])) {
		$ExidVisiteur =$_POST['idV'];
		$Excivilite = $_POST['ListCivilites'];
		$Exnom = $_POST['nom'];
		$Exprenom = $_POST['prenom'];
		$ExnomAsso = $_POST['nomAsso'];
		$ExnumAsso = $_POST['numAsso'];
		$Exemail=$_POST['email'];
		$Exville=$_POST['ville'];
		$Extel = $_POST['tel'];
		$Exadresse = $_POST['adresse'];
		$ExcodePostal = $_POST['codePostal'];
		$ExPassword =EncryptPassword('');
		if(!empty($Excivilite) && !empty($Exnom) && !empty($Exprenom) && !empty($ExnomAsso) 
		&& !empty($ExnumAsso) && !empty($Exemail) && !empty($Exville) && !empty($Extel)&& !empty($Exadresse)&& !empty($ExcodePostal)){
			
			global $wpdb;
			$result=$wpdb->update( 
				'ste_visiteurs', 
				array('civilite' => $Excivilite,'nom' => $Exnom, 'prenom' =>$Exprenom,
			'nomAsso' => $ExnomAsso, 'numAsso' => $ExnumAsso, 'ville' => $Exville, 'Tel' => $Extel,'adresse' =>$Exadresse
			,'codepostal' =>$ExcodePostal)
			,array( 'id' => $ExidVisiteur)
			);
			
			$result=$wpdb->update( 
				'ste_connexion', 
				array('email' => $Exemail,'password' =>$ExPassword)
			,array( 'userid' => $ExidVisiteur,'role'=>1)
			);
			
		}
	
		//reactualiser les données de l'utilisateur
		$_SESSION['MUcivilite']=$Excivilite;
		$_SESSION['MUnom']=$Exnom;
		$_SESSION['MUprenom']=$Exprenom;
		$_SESSION['MUnomAsso']=$ExnomAsso;
		$_SESSION['MUnumAsso']=$ExnumAsso;
		$_SESSION['MUemail']=$Exemail;
		$_SESSION['MUville']=$Exville;
		$_SESSION['MUtel']=$Extel;
		$_SESSION['MUadresse']=$Exadresse;
		$_SESSION['MUcodePostal']=$ExcodePostal;
		///Notify: user succesfully updated
	}
}
UpdateVisiteurInfo();
addNewVisteur();
?>
<form method="post" name="Modify-Visiteur">
<div class="wrap">
	<input type="hidden" name="idV" value="<?php if(!empty($idVisiteur)){ echo $idVisiteur;};?>"/>
	<div>
		<label>Civilite</label>
		<select name="ListCivilites">
			<option>Selectionner</option>
		<?php if(!empty($idVisiteur)){
		getListCivilites($_SESSION['MUcivilite']); 
		}
		else{
		getListCivilites(null);
		}?>
		</select>
	</div>
	
	<div style="width:100%">
		<label>Nom</label>
		<input type="text" name="nom" 
		value="<?php if(!empty($idVisiteur)){
						getVisiteurNom();
						}?>"/>

		<label>Pr&eacute;nom</label>
		<input type="text" name="prenom" 
		value="<?php if(!empty($idVisiteur)){
						getVisiteurPrenom(); 
						}?>"/>
	</div>
	<div style="width:100%">
		<label>Libelle de l'asso</label>
		<input type="text" name="nomAsso" 
		value="<?php if(!empty($idVisiteur)){
						getVisiteurnomAsso();
						} ?>"/>
						
		<label>N° de l'asso</label>
		<input type="text" name="numAsso" 
		value="<?php if(!empty($idVisiteur)){
						getVisiteurnumAsso(); 
						}?>"/>
	</div>
	
	<div>
		<label>Email</label>
		<input type="text" name="email" 
			value="<?php if(!empty($idVisiteur)){
							getVisiteurEmail(); 
							}?>"/>
							
		<label>Tel</label>
		<input type="text" name="tel" 
			value="<?php if(!empty($idVisiteur)){
							getVisiteurtel();
							} ?>"/>			
	</div>
	<div style="width:100%">
	<label>Adresse</label>
		<input type="text" name="adresse" 
			value="<?php if(!empty($idVisiteur)){
							getVisiteurAdresse();
							} ?>"/>
		<label>Ville</label>
		<input type="text" name="ville" 
			value="<?php if(!empty($idVisiteur)){
							getVisiteurVilles();
							} ?>"/>
	</div>
	<div>
		<label>codePostal</label>
		<input type="text" name="codePostal" 
			value="<?php if(!empty($idVisiteur)){
							getVisiteurCodePostal();
							} ?>"/>
	</div>
	
<div class="wrap">
<input type="submit" value="Enregistrer" name="user-update" class="button-primary"/>
<a href="#" class="button-secondary"> Annuler</a>
</div>
</form>