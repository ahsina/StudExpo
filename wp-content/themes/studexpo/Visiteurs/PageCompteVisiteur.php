<?php 
/*
Template Name: VisiteursCompte
*/
UpdateVisiteurInfo();
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
					<div class="clear"></div>
					<p>

						<?php 

						if ( have_posts() ) : while( have_posts() ) : the_post();
					    the_content();
						endwhile; endif;
						
						?>

					</p>
<h2>Vos informations personnelles</h2>
					
					<div class="form-style">
						<form method="post" name="Modify-Visiteur">
							<div class="wrap">
								<input type="hidden" name="id" value="<?php echo $_SESSION['ID'];?>"/>
								<div class="bloc-form-civilite">
									<label>Civilite</label><br />
									<select name="ListCivilites">
										<option>Selectionner</option>
										<?php getListCivilites($_SESSION['civilite']);?>
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
									<label>Libelle de l'association</label><br />
									<input type="text" name="nomAsso" value="<?php echo stripslashes($_SESSION['nomAsso']); ?>"/>
								</div>

								<div class="bloc-form">				
									<label>N° de l'association</label><br />
									<input type="text" name="numAsso" value="<?php echo stripslashes($_SESSION['numAsso']); ?>"/>
								</div>
								
								<div class="bloc-form pair-bloc">
									<label>Email</label><br />
									<input type="text" name="email" value="<?php echo stripslashes($_SESSION['email']); ?>"/>
								</div>

								<div class="bloc-form">				
									<label>Tel</label><br />
									<input type="text" name="tel" value="<?php echo stripslashes($_SESSION['tel']); ?>"/>			
								</div>

								<div class="bloc-form pair-bloc">
									<label>Adresse</label><br />
									<input type="text" name="adresse" value="<?php echo stripslashes($_SESSION['adresse']); ?>"/>
								</div>

								<div class="bloc-form">
									<label>Adresse (suite)</label><br />
									<input type="text" name="adresseSuite" value=""/>
								</div>

								<div class="bloc-form pair-bloc">
									<label>Code postal</label><br />
									<input type="text" name="codePostal" value="<?php echo stripslashes($_SESSION['codePostal']); ?>"/>
								</div>

								<div class="bloc-form">
									<label>Ville</label><br />
									<input type="text" name="ville" value="<?php echo stripslashes($_SESSION['ville']); ?>"/>
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
}
else{
	header('Location: '.get_home_url());  
}

function UpdateVisiteurInfo(){
	if (!empty($_POST['id'])) {
		$ExidVisiteur =$_POST['id'];
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
		$ExPassword =EncryptPassword($_POST['password']);
		if(!empty($Excivilite) && !empty($Exnom) && !empty($Exprenom) && !empty($ExnomAsso) 
		&& !empty($ExnumAsso) && !empty($Exemail) && !empty($Exville) && !empty($Extel)&& !empty($Exadresse)&& !empty($ExcodePostal)){
			
			global $wpdb;
			$result=$wpdb->update( 
				'ste_visiteurs', 
				array('civilite' => $Excivilite,'nom' => $Exnom, 'prenom' =>$Exprenom,
			'NomAsso' => $ExnomAsso, 'NumAsso' => $ExnumAsso, 'ville' => $Exville, 'Tel' => $Extel,'adresse' =>$Exadresse
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
		$_SESSION['civilite']=$Excivilite;
		$_SESSION['nom']=$Exnom;
		$_SESSION['prenom']=$Exprenom;
		$_SESSION['nomAsso']=$ExnomAsso;
		$_SESSION['numAsso']=$ExnumAsso;
		$_SESSION['email']=$Exemail;
		$_SESSION['ville']=$Exville;
		$_SESSION['tel']=$Extel;
		$_SESSION['adresse']=$Exadresse;
		$_SESSION['codePostal']=$ExcodePostal;
		///Notify: user succesfully updated
	}
}

get_footer();
?>