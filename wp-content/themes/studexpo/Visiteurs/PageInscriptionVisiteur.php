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
					<div class="clear"></div>
					<p>

						<?php 

						if ( have_posts() ) : while( have_posts() ) : the_post();
					    the_content();
						endwhile; endif;
						
						?>

					</p>
					
					<img src="http://www.stud-expo.fr/StudExpo/wp-content/themes/studexpo/img/temp/page6.jpg" width="100%" style="margin-bottom:30px;" />
					<img src="http://www.stud-expo.fr/StudExpo/wp-content/themes/studexpo/img/temp/page7.jpg" width="100%" style="margin-bottom:30px;" />
					<h2>S'inscrire pour visiter le salon</h2>
					
					
					<div class="form-style">
						<form method="post" name="Modify-Visiteur">
							<div class="wrap">
								<input type="hidden" name="idV" value="<?php if(!empty($idVisiteur)){ echo $idVisiteur;};?>"/>
								<div class="bloc-form-civilite">
									<label>Civilite</label><br />
									<select>
										<option>Selectionner</option>
										<?php getListCivilites(null);?>
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
									<label>Libelle de l'association</label><br />
									<input type="text" name="nomAsso" value=""/>
								</div>

								<div class="bloc-form">				
									<label>N° de l'association</label><br />
									<input type="text" name="numAsso" value=""/>
								</div>
								
								<div class="bloc-form pair-bloc">
									<label>Email</label><br />
									<input type="text" name="email" value=""/>
								</div>

								<div class="bloc-form">				
									<label>Tel</label><br />
									<input type="text" name="tel" value=""/>			
								</div>

								<div class="bloc-form pair-bloc">
									<label>Adresse</label><br />
									<input type="text" name="adresse" value=""/>
								</div>

								<div class="bloc-form">
									<label>Adresse (suite)</label><br />
									<input type="text" name="adresse" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Code postal</label><br />
									<input type="text" name="codePostal" value=""/>
								</div>

								<div class="bloc-form">
									<label>Ville</label><br />
									<input type="text" name="ville" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Mot de passe</label><br />
										<input type="password" name="password" 	value=""/>
								</div>

								<div class="bloc-form">
									<label>Confirmation</label><br />
										<input type="password" name="confirmation" 	value=""/>
								</div>
								<div class="bloc-form-validate">
									<button type="submit" value="Enregistrer" name="user-update" class="btn button-primary valider">Valider</button>
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