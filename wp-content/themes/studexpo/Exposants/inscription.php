<?php 
/*
Template Name: testexposer
*/


get_header();
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
			$NUpassword = $_POST['password'];
			$NUconfirmation = $_POST['confirmation'];
			
			if(!empty($NUpassword) && !empty($NUconfirmation) && $NUpassword==$NUconfirmation){
				if(!empty($NUlibelleEntreprise) && !empty($NUNumSiret) && !empty($NUSecteurActivite) && !empty($NUAdresseSiege) 
				&& !empty($NUCodePostal) && !empty($NUVille) && !empty($NUCivilite) && !empty($NUnom) && !empty($NUprenom) && !empty($NUfonction)
				&& !empty($NUemail)){
					$Password = EncryptPassword($NUpassword);
					global $wpdb;
					$wpdb->insert( 
					'ste_exposants', 
					array('id' => NULL,'libelleEntreprise' => $NUlibelleEntreprise,'NumSiret' => $NUNumSiret, 'SecteurActivite' =>$NUSecteurActivite,
					'AdresseSiege' => $NUAdresseSiege, 'CodePostal' => $NUCodePostal, 'Ville' => $NUVille, 'Civilite' => $NUCivilite, 'nom' => $NUnom,
					'prenom' => $NUprenom, 'fonction' => $NUfonction)
					);
					
					$wpdb->insert( 
					'ste_connexion', 
					array('id' => NULL, 'email' => $NUemail,'password' => $Password,'role'=>2,'userid'=>$wpdb->insert_id)
					);
					
					///Notify: user succesfully Added
				}
			}
			else{
				///Notify: password incorrect
			}
		}
	
	}
	
	addNewExposant();
	
?>


<div class="page page-index">
	<div class="header-page">
		<div class="title">
			<h1><?php echo get_the_title(); ?></h1>
		</div>
	</div>
	<div class="content-inter">
		<div class="container-content">
			<div class="container">
				<h2>Insere ton texte ma gueule !</h2>
				<p>j'ai dit ton texte ma gueule !</p>
				<form method="post" name="Modify-Exposant">
					<div class="wrap">
						<input type="hidden" name="idV" value="<?php if(!empty($idExposant)){ echo $idExposant;};?>"/>
						<div>
							
						</div>

						<div style="width:100%">
							<label>Libelle de l'entreprise</label>
							<input type="text" name="libelleEntreprise" 
							value=""/>

							<label>N° de SIRET</label>
							<input type="text" name="NumSiret" 
							value=""/>
						</div>
						<div style="width:100%">
							<label>Secteur d'activité</label>
							<input type="text" name="SecteurActivite" 
							value=""/>
							<label>Adresse du siege</label>
							<input type="text" name="AdresseSiege" value=""/>
						</div>

						<div>
							<label>Code postal</label>
								<input type="text" name="CodePostal" value=""/>
												
							<label>Ville</label>
							<input type="text" name="Ville" value=""/>
							
						</div>
						<div style="width:100%">
							<label>Civilite</label>
							<?php 
							getListCivilites(null);
							?>
							
							<label>Nom</label>
							<input type="text" name="nom" value=""/>
												
						</div>
						<div>						
							<label>Prenom</label>
							<input type="text" name="prenom" value=""/>
												
							<label>Fonction</label>
							<input type="text" name="fonction" value=""/>
						</div>
						<div>
							<label>Email</label>
							<input type="text" name="email" value=""/>
						</div>
						<div>
							<label>Mot de passe</label>
								<input type="password" name="password" 	value=""/>
						</div>
						<div>
							<label>Confirmation</label>
								<input type="password" name="confirmation" 	value=""/>
						</div>
						
					<div class="wrap">
						<input type="submit" value="Enregistrer" name="user-update" class="button-primary"/>
						<a href="#" class="button-secondary"> Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- GALLERY -->
</div>




<?php
get_footer();
?>