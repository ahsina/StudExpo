<?php 
/*
Template Name: ExposantCompte
*/

UpdateExposantInfo();
get_header();
if(CheckLogin()) {
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

					<h2>Vos informations personnelles</h2>
					<p><?php if ( have_posts() ) : while( have_posts() ) : the_post(); 
						the_content();
						endwhile; endif; ?>
					</p>
					<div class="form-style">
						<form method="post" name="Modify-Visiteur">
							<div class="wrap">

								<input type="hidden" name="id" value="<?php echo $_SESSION['ID'];?>"/>
								<div class="bloc-form-civilite">
									<label>Civilite</label><br />
									<select name="ListCivilites">
										<option>Selectionner</option>
										<?php 
											getListCivilites($_SESSION['civilite']);
										?>
									</select>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Nom</label><br />
									<input type="text" name="nom" value="<?php echo stripslashes($_SESSION['nom']); ?>"/>
								</div>

								<div class="bloc-form">
									<label>Prénom</label><br />
									<input type="text" name="prenom" value="<?php echo stripslashes($_SESSION['prenom']); ?>"/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Fonction</label><br />
									<input type="text" name="fonction" value="<?php echo stripslashes($_SESSION['fonction']); ?>"/>
								</div>
								
								<div class="bloc-form">
									<label>Email</label><br />
									<input type="text" name="email" value="<?php echo stripslashes($_SESSION['email']); ?>"/>
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
									<input type="text" name="libelleEntreprise" value="<?php echo stripslashes($_SESSION['libelleEntreprise']);?>"/>			
								</div>

								<div class="bloc-form">
									<label>Numéro SIRET</label><br />
									<input type="text" name="NumSiret" value="<?php echo stripslashes($_SESSION['NumSiret']);?>"/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Secteur d'activité</label><br />
									<input type="text" name="SecteurActivite" value="<?php echo stripslashes($_SESSION['SecteurActivite']);?>"/>
								</div>

								<div class="bloc-form">
									<label>Adresse du siège</label><br />
									<input type="text" name="AdresseSiege" value="<?php echo stripslashes($_SESSION['AdresseSiege']);?>"/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Code postal</label><br />
									<input type="text" name="codePostal" value="<?php echo stripslashes($_SESSION['CodePostal']);?>"/>
								</div>

								<div class="bloc-form">
									<label>Ville</label><br />
									<input type="text" name="ville" value="<?php echo stripslashes($_SESSION['Ville']);?>"/>
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
}
else{
header('Location: '.get_home_url());  
}

function UpdateExposantInfo(){
	if (!empty($_POST['id'])){
		$ExidExposant =$_POST['id'];
		$ExlibelleEntreprise = $_POST['libelleEntreprise'];
		$ExNumSiret = $_POST['NumSiret'];
		$ExSecteurActivite = $_POST['SecteurActivite'];
		$ExAdresseSiege = $_POST['AdresseSiege'];
		$ExCodePostal = $_POST['codePostal'];
		$ExVille=$_POST['ville'];
		$ExCivilite=$_POST['ListCivilites'];
		$Exnom = $_POST['nom'];
		$Exprenom = $_POST['prenom'];
		$Exfonction = $_POST['fonction'];
		$Exemail = $_POST['email'];
		$ExPassword =EncryptPassword($_POST['password']);
		if(!empty($ExidExposant) && !empty($ExlibelleEntreprise) && !empty($ExNumSiret) && !empty($ExSecteurActivite) 
		&& !empty($ExAdresseSiege) && !empty($ExCodePostal) && !empty($ExVille) && !empty($ExCivilite) && !empty($Exnom) && !empty($Exprenom)
		&& !empty($Exfonction)&& !empty($Exemail)){
			
			global $wpdb;
			$result=$wpdb->update( 
				'ste_exposants', 
				array('civilite' => $ExCivilite,'libelleEntreprise' => $ExlibelleEntreprise, 'NumSiret' =>$ExNumSiret,
			'SecteurActivite' => $ExSecteurActivite, 'AdresseSiege' => $ExAdresseSiege, 'CodePostal' => $ExCodePostal, 'Ville' => $ExVille,
			'nom' => $Exnom,'prenom' => $Exprenom, 'fonction' => $Exfonction),array( 'id' => $ExidExposant)
			);
			
			$result=$wpdb->update( 
				'ste_connexion', 
				array('email' => $Exemail,'password' =>$ExPassword)
			,array( 'userid' => $ExidExposant,'role'=>2)
			);
		}
	
		//reactualiser les données de l'utilisateur
		$_SESSION['ID']=$_POST['id'];
		$_SESSION['civilite']=$ExCivilite;
		$_SESSION['libelleEntreprise']=$ExlibelleEntreprise;
		$_SESSION['NumSiret']=$ExNumSiret;
		$_SESSION['SecteurActivite']=$ExSecteurActivite;
		$_SESSION['AdresseSiege']=$ExAdresseSiege;
		$_SESSION['CodePostal']=$ExCodePostal;
		$_SESSION['Ville']=$ExVille;
		$_SESSION['nom']=$Exnom;
		$_SESSION['prenom']=$Exprenom;
		$_SESSION['fonction']=$Exfonction;
		$_SESSION['email']=$Exemail;
		///Notify: user succesfully updated
	}
}

get_footer();
?>