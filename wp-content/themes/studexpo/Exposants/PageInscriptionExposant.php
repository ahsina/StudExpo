<?php 
/*
Template Name: ExposantInscription
*/


get_header();
function addNewExposant(){
		if (empty($_POST['idV'])) {
			$NUlibelleEntreprise = $_POST['libelleEntreprise'];
			$NUNumSiret = $_POST['NumSiret'];
			$NUSecteurActivite = $_POST['SecteurActivite'];
			$NUAdresseSiege = $_POST['AdresseSiege'];
			$NUCodePostal = $_POST['codePostal'];
			$NUVille=$_POST['ville'];
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
					<h2>S'inscrire pour exposer dans le salon</h2>
					<p><?php if ( have_posts() ) : while( have_posts() ) : the_post();
     the_content();
endwhile; endif; ?></p>
					<div class="form-style">
						<form method="post" name="Modify-Visiteur">
							<div class="wrap">
								<input type="hidden" name="idV" value="<?php if(!empty($idExposant)){ echo $idExposant;};?>"/>
								<div class="bloc-form-civilite">
									<label>Civilite</label><br />
									<select name="ListCivilites">
										<option>Selectionner</option>
										<?php 
											getListCivilites(null);
										?>
									</select>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Nom</label><br />
									<input type="text" name="nom" value=""/>
								</div>

								<div class="bloc-form">
									<label>Prénom</label><br />
									<input type="text" name="prenom" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Fonction</label><br />
									<input type="text" name="fonction" value=""/>
								</div>
								
								<div class="bloc-form">
									<label>Email</label><br />
									<input type="text" name="email" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Mot de passe</label><br />
										<input type="password" name="password" 	value=""/>
								</div>

								<div class="bloc-form">
									<label>Confirmation</label><br />
										<input type="password" name="confirmation" 	value=""/>
								</div>

								<div class="bloc-form pair-bloc">				
									<label>Libellé de l'entreprise</label><br />
									<input type="text" name="libelleEntreprise" value=""/>			
								</div>

								<div class="bloc-form">
									<label>Numéro SIRET</label><br />
									<input type="text" name="NumSiret" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Secteur d'activité</label><br />
									<input type="text" name="SecteurActivite" value=""/>
								</div>

								<div class="bloc-form">
									<label>Adresse du siège</label><br />
									<input type="text" name="AdresseSiege" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Code postal</label><br />
									<input type="text" name="codePostal" value=""/>
								</div>

								<div class="bloc-form">
									<label>Ville</label><br />
									<input type="text" name="ville" value=""/>
								</div>

								
								<div class="bloc-form-validate">
									<button type="submit" name="user-Add" class="btn button-primary valider">Valider</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- GALLERY -->
	</div>

<?php
get_footer();
?>