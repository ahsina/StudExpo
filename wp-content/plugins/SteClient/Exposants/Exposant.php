<?php 	
	function addNewExposant(){
		if (empty($_POST['idV'])) {
			$NUlibelleEntreprise = $_POST['libelleEntreprise'];
			$NUNumSiret = $_POST['NumSiret'];
			$NUSecteurActivite = $_POST['SecteurActivite'];
			$NUAdresseSiege = $_POST['AdresseSiege'];
			$NUCodePostal = $_POST['CodePostal'];
			$NUVille=$_POST['Ville'];
			$NUCivilite=$_POST['ListCivilites'];
			$NUnom = $_POST['nom'];
			$NUprenom = $_POST['prenom'];
			$NUfonction = $_POST['fonction'];
			$NUemail = $_POST['email'];
			
			if(!empty($NUlibelleEntreprise) && !empty($NUNumSiret) && !empty($NUSecteurActivite) && !empty($NUAdresseSiege) 
			&& !empty($NUCodePostal) && !empty($NUVille) && !empty($NUCivilite) && !empty($NUnom) && !empty($NUprenom) && !empty($NUfonction)
			&& !empty($NUemail)){

				global $wpdb;
				$resut=$wpdb->insert( 
				'ste_exposants', 
				array('id' => NULL,'libelleEntreprise' => $NUlibelleEntreprise,'NumSiret' => $NUNumSiret, 'SecteurActivite' =>$NUSecteurActivite,
				'AdresseSiege' => $NUAdresseSiege, 'CodePostal' => $NUCodePostal, 'Ville' => $NUVille, 'Civilite' => $NUCivilite, 'nom' => $NUnom,
				'prenom' => $NUprenom, 'fonction' => $NUfonction, 'email' => $NUemail)
				);
				///Notify: user succesfully Added
			}

		}
	
	}
	
	function getExposantLibelleEntreprise(){
		echo $_SESSION['MUlibelleEntreprise'];
	}
	function getExposantNumSiret(){
		echo $_SESSION['MUNumSiret'];
	}
	function getExposantSecteurActivite(){
		echo $_SESSION['MUSecteurActivite'];
	}
	function getExposantAdresseSiege(){
		echo $_SESSION['MUAdresseSiege'];
	}
	function getExposantCodePostal(){
		echo $_SESSION['MUCodePostal'];
	}
	function getExposantVille(){
		echo $_SESSION['MUVille'];
	}	
	function getExposantCivilite(){
		echo $_SESSION['MUCivilite'];
	}
	function getExposantNom(){
		echo $_SESSION['MUnom'];
	}
	function getExposantPrenom(){
		echo $_SESSION['MUprenom'];
	}
	function getExposantFonction(){
		echo $_SESSION['MUfonction'];
	}
	function getExposantEmail(){
		echo $_SESSION['MUemail'];
	}
	
if (!empty($_POST['idExposant'])) {
	$idExposant=$_POST['idExposant'];
	getExposantInfo($idExposant);
}
	
?>

<?php
	
function getExposantInfo($id){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT cl.civilite,cl.libelleEntreprise,cl.NumSiret,cl.SecteurActivite,cl.AdresseSiege,cl.CodePostal,cl.Ville,cl.nom,cl.prenom,cl.fonction,cl.email
		FROM ste_exposants cl where id=".$id);
		
		$_SESSION['ID']=$id;
		$_SESSION['MUlibelleEntreprise']=$user[0]->libelleEntreprise;
		$_SESSION['MUNumSiret']=$user[0]->NumSiret;
		$_SESSION['MUSecteurActivite']=$user[0]->SecteurActivite;
		$_SESSION['MUAdresseSiege']=$user[0]->AdresseSiege;
		$_SESSION['MUCodePostal']=$user[0]->CodePostal;
		$_SESSION['MUVille']=$user[0]->Ville;
		$_SESSION['civilite']=$user[0]->civilite;
		$_SESSION['MUnom']=$user[0]->nom;
		$_SESSION['MUprenom']=$user[0]->prenom;
		$_SESSION['MUfonction']=$user[0]->fonction;
		$_SESSION['MUemail']=$user[0]->email;
		
}
function UpdateExposantInfo(){
	if (!empty($_POST['idV'])) {
		$ExidExposant =$_POST['idV'];
		$ExlibelleEntreprise = $_POST['libelleEntreprise'];
		$ExNumSiret = $_POST['NumSiret'];
		$ExSecteurActivite = $_POST['SecteurActivite'];
		$ExAdresseSiege = $_POST['AdresseSiege'];
		$ExCodePostal = $_POST['CodePostal'];
		$ExVille=$_POST['Ville'];
		$ExCivilite=$_POST['ListCivilites'];
		$Exnom = $_POST['nom'];
		$Exprenom = $_POST['prenom'];
		$Exfonction = $_POST['fonction'];
		$Exemail = $_POST['email'];
		$result="";
		if(!empty($ExidExposant) && !empty($ExlibelleEntreprise) && !empty($ExNumSiret) && !empty($ExSecteurActivite) 
		&& !empty($ExAdresseSiege) && !empty($ExCodePostal) && !empty($ExVille) && !empty($ExCivilite) && !empty($Exnom) && !empty($Exprenom)
		&& !empty($Exfonction)&& !empty($Exemail)){
			
			global $wpdb;
			$result=$wpdb->update( 
				'ste_exposants', 
				array('civilite' => $ExCivilite,'libelleEntreprise' => $ExlibelleEntreprise, 'NumSiret' =>$ExNumSiret,
			'SecteurActivite' => $ExSecteurActivite, 'AdresseSiege' => $ExAdresseSiege, 'CodePostal' => $ExCodePostal, 'Ville' => $ExVille,
			'nom' => $Exnom,'prenom' => $Exprenom, 'fonction' => $Exfonction,'email' => $Exemail),array( 'id' => $ExidExposant)
			);
		}
	
		//reactualiser les données de l'utilisateur
		$_SESSION['MUcivilite']=$ExCivilite;
		$_SESSION['MUlibelleEntreprise']=$ExlibelleEntreprise;
		$_SESSION['MUNumSiret']=$ExNumSiret;
		$_SESSION['MUSecteurActivite']=$ExSecteurActivite;
		$_SESSION['MUAdresseSiege']=$ExAdresseSiege;
		$_SESSION['MUCodePostal']=$ExCodePostal;
		$_SESSION['MUVille']=$ExVille;
		$_SESSION['MUnom']=$Exnom;
		$_SESSION['MUprenom']=$Exprenom;
		$_SESSION['MUfonction']=$Exfonction;
		$_SESSION['MUemail']=$Exemail;
		///Notify: user succesfully updated
	}
}
UpdateExposantInfo();
addNewExposant();
?>
<form method="post" name="Modify-Exposant">
<div class="wrap">
	<input type="hidden" name="idV" value="<?php if(!empty($idExposant)){ echo $idExposant;};?>"/>
	<div>
		
	</div>

	<div style="width:100%">
		<label>Libelle de l'entreprise</label>
		<input type="text" name="libelleEntreprise" 
		value="<?php if(!empty($idExposant)){
						getExposantLibelleEntreprise();
						}?>"/>

		<label>N° de SIRET</label>
		<input type="text" name="NumSiret" 
		value="<?php if(!empty($idExposant)){
						getExposantNumSiret(); 
						}?>"/>
	</div>
	<div style="width:100%">
		<label>Secteur d'activité</label>
		<input type="text" name="SecteurActivite" 
		value="<?php if(!empty($idExposant)){
						getExposantSecteurActivite();
						} ?>"/>
		<label>Adresse du siege</label>
		<input type="text" name="AdresseSiege" 
		value="<?php if(!empty($idExposant)){
						getExposantAdresseSiege(); 
						}?>"/>
	</div>

	<div>
		<label>Code postal</label>
			<input type="text" name="CodePostal" 
			value="<?php if(!empty($idExposant)){
							getExposantCodePostal(); 
							}?>"/>
							
		<label>Ville</label>
		<input type="text" name="Ville" 
			value="<?php if(!empty($idExposant)){
							getExposantVille(); 
							}?>"/>
		
	</div>
	<div style="width:100%">
		<label>Civilite</label>
		<?php if(!empty($idExposant)){
		getListCivilites($_SESSION['MUcivilite']); 
		}
		else{
		getListCivilites(null);
		}?>
		
		<label>Nom</label>
		<input type="text" name="nom" 
			value="<?php if(!empty($idExposant)){
							getExposantnom(); 
							}?>"/>
							
	</div>
	<div>						
		<label>Prenom</label>
		<input type="text" name="prenom" 
			value="<?php if(!empty($idExposant)){
							getExposantprenom(); 
							}?>"/>
							
		<label>Fonction</label>
		<input type="text" name="fonction" 
			value="<?php if(!empty($idExposant)){
							getExposantfonction(); 
							}?>"/>
	</div>
	<div>
		<label>Email</label>
		<input type="text" name="email" 
			value="<?php if(!empty($idExposant)){
							getExposantemail(); 
							}?>"/>
	</div>
	
<div class="wrap">
<input type="submit" value="Enregistrer" name="user-update" class="button-primary"/>
<a href="#" class="button-secondary"> Annuler</a>
</div>
</form>