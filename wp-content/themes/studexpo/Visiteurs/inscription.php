<?php 
/*
Template Name: VisiteursInscription
*/


get_header();

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
			$NUpassword = $_POST['password'];
			$NUconfirmation = $_POST['confirmation'];

			if(!empty($NUpassword) && !empty($NUconfirmation) && $NUpassword==$NUconfirmation){
				if(!empty($NUcivilite) && !empty($NUnom) && !empty($NUprenom) && !empty($NUnomAsso) 
				&& !empty($NUnumAsso) && !empty($NUemail) && !empty($NUville) && !empty($NUtel)&& 
				!empty($NUadresse) && !empty($NUcodePostal)){
				$Password = EncryptPassword($NUpassword);
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
			else{
			///Notify: Password Incorrect
			}
		}
	
}
	
	addNewVisteur();
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
				<form method="post" name="Modify-Visiteur">
					<div class="wrap">
						<input type="hidden" name="idV" value="<?php if(!empty($idVisiteur)){ echo $idVisiteur;};?>"/>
						<div>
							<label>Civilite</label>
							<?php getListCivilites(null);?>
						</div>
						
						<div style="width:100%">
							<label>Nom</label>
							<input type="text" name="nom" value=""/>

							<label>Pr&eacute;nom</label>
							<input type="text" name="prenom" value=""/>
						</div>
						<div style="width:100%">
							<label>Libelle de l'asso</label>
							<input type="text" name="nomAsso" value=""/>
											
							<label>N° de l'asso</label>
							<input type="text" name="numAsso" value=""/>
						</div>
						
						<div>
							<label>Email</label>
							<input type="text" name="email" value=""/>
												
							<label>Tel</label>
							<input type="text" name="tel" value=""/>			
						</div>
						<div style="width:100%">
						<label>Adresse</label>
							<input type="text" name="adresse" value=""/>
							<label>Ville</label>
							<input type="text" name="ville" value=""/>
						</div>
						<div>
							<label>codePostal</label>
							<input type="text" name="codePostal" value=""/>
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