<?php 
/*
Template Name: VisiteursConcours
*/
getUserConcoursInfo();
if(!empty($_POST['etape']) && isset($_POST['btnstep1'])){
	AddNewUserConcours();
}

if(!empty($_POST['etape']) && isset($_POST['btnstep2'])){
	UpdateVisiteurInfo();
	updateStep(2);
}

if(!empty($_POST['etape']) && isset($_POST['btnstep3'])){
	updateStep(3);
}

if(!empty($_POST['etape']) && isset($_POST['btnstep4'])){
	updateStep(4);
}

if(!empty($_POST['etape']) && isset($_POST['btnstep5'])){
	updateStep(5);
}
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
					<h2>Etape 1 : Veuillez saisir les informations suivantes</h2></br>
					<div class="form-style">
					<form name="step_1" method="post" action="">
						<div class="bloc-form pair-bloc">
							<label>Nom de l'école</label>
							<input type="hidden" name="userconcours" value="<?php echo $_SESSION['userconcours']; ?>" />
							<input type="text" name="LibelleEcole" 
							value="<?php echo $_SESSION['LibelleEcole']; ?>"/>
						</div>

						<div class="bloc-form">				
							<label>Nombre d'etudiant de l'ecole</label>
							<input type="text" name="NbEtudiantEcole" 
							value="<?php echo $_SESSION['NbEtudiantEcole']; ?>"/>
						</div>
						
						<div class="bloc-form pair-bloc">
							<label>Nom de l'asso</label>
							<input type="text" name="LibelleAsso" 
							value="<?php echo $_SESSION['LibelleAsso'];?>"/>
						</div>

						<div class="bloc-form">	
							<label>N° de l'asso</label>
							<input type="text" name="numAsso" 
							value="<?php echo $_SESSION['numAsso']; ?>"/>
						</div>
						
						<div class="bloc-form pair-bloc">				
							<label>Nombre de personne affilié</label>
							<input type="text" name="NbPersonneAsso" 
							value="<?php echo $_SESSION['NbPersonneAsso']; ?>"/>	
						</div>
						<div class="bloc-form" >	
							</br>
							<input type="hidden" name="etape" value="1" />
							<button style="float:right" name="btnstep1" onclick="window.location='?page_id=41'" class="btn button-primary valider">Suivant</button>
						</div>
						</form>
					</div>
					
					</br>
					
					<h2>Etape 2 : Veuillez verifier vos informations personnelles</h2>
					</br>
					<div class="form-style">
						<form method="post" name="Modify-Visiteur">
							<div class="wrap">
								<input type="hidden" name="id" value="<?php echo $_SESSION['ID'];?>"/>
								<input type="hidden" name="userconcours" value="<?php echo $_SESSION['userconcours']; ?>" />
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

								<div class="bloc-form-validate">
								<input type="hidden" name="etape" value="2" />
									<button type="submit" value="Enregistrer" name="btnstep2" class="btn button-primary valider">Valider</button>
								</div>
							</div>
						</form>
					</div>
					</br>
					
					<h2>Etape 3 : Pièces</h2>
					</br>
					<div class="form-style">
					<form action="" method="post" name="step_3">
						<p>
							Veuillez telecharger les fichiers ci-dessous...
						</p>
						<div class="bloc-form pair-bloc">
						<input type="hidden" name="userconcours" value="<?php echo $_SESSION['userconcours']; ?>" />
						<label>R.I.B</label></br>
						<button type="submit" class="btn button-secondary" name="submit">R.I.B</button></br>
						</div>
						<div class="bloc-form">
						<label>Plaquette</label></br>
						<button type="submit" class="btn button-secondary" name="submit">Plaquette commercial</button></br>
						</div>
						<div class="bloc-form">
						</br>
						<input type="hidden" name="etape" value="3" />
						<button type="submit" name="btnstep3" class="btn button-primary valider" name="submit">Suivant</button></br>
						</div>
						</form>
					</div>
					</br>
					</br>
					<h2>Etape 4 : Confirmation de paiement</h2>
					</br>
					<form name="step_4" method="post" action="">
					<div class="form-style">
					<input type="hidden" name="userconcours" value="<?php echo $_SESSION['userconcours']; ?>" />
						<p>
							Félicitation, vous êtes officielement inscrit au concours STUD'EXPO. Vous allez être bientôt contacter par nos équipes pour vous informez de la suite de la procedure.
						</p>
						<div class="bloc-form">
						<input type="hidden" name="etape" value="4" />
						<button type="submit" name="btnstep4" class="btn button-primary valider" name="submit">Confirmer le virement</button></br>
						</div>
					</div>
					</form>
					</br>
					</br>
					<h2>Etape 5 : Contenu de votre concours</h2>
					</br>
					<form name="step_5" method="post" action="">
					<div class="form-style">
					<input type="hidden" name="userconcours" value="<?php echo $_SESSION['userconcours']; ?>" />
						<p> Veuillez charger le contenu de votre concours </p>
						<div class="bloc-form pair-bloc">
							<label>Contenu du concours</label>
							<br />
							<input type="file" name="ContenuConcours" />
						</div>
						<div class="bloc-form">
							<input type="hidden" name="etape" value="5" />
							<button style="float:right" type="submit" name="btnstep5" class="btn button-primary valider" name="submit">Terminer</button></br>
						</div>
					</div>
					</form>
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

function updateStep($step){
	global $wpdb;
	$resut=$wpdb->update( 
			'ste_UserConcours', 
			array('step'=>$step),array('id' => $_SESSION['userconcours'])
			);
}
function AddNewUserConcours(){

						
			$NUidVisiteur=$_SESSION['ID'];
			$NUnumAsso = $_POST['numAsso'];
			$NULibelleEcole = $_POST['LibelleEcole'];
			$NULibelleAsso = $_POST['LibelleAsso'];
			$NUNbEtudiantEcole = $_POST['NbEtudiantEcole'];
			$NUNbPersonneAsso = $_POST['NbEtudiantEcole'];
					
			if(!empty($NUnumAsso) && !empty($NULibelleEcole) && !empty($NULibelleAsso) 
			&& !empty($NUNbEtudiantEcole) && !empty($NUNbPersonneAsso) ){
				
				if(!empty($_POST['userconcours'])){
					$_SESSION['userconcours']=$_POST['userconcours'];
					global $wpdb;
					$resut=$wpdb->update( 
					'ste_UserConcours', 
					array('idvisiteur' => $NUidVisiteur,'numAsso' => $NUnumAsso,
					'LibelleEcole' => $NULibelleEcole,'LibelleAsso' => $NULibelleAsso,'NbEtudiantEcole' => $NUNbEtudiantEcole,
					'NbPersonneAsso' => $NUNbPersonneAsso,'step'=>1),array('id' => $_POST['userconcours'])
					);
				}
				else{
					global $wpdb;
					$resut=$wpdb->insert( 
					'ste_UserConcours', 
					array('id' => NULL,'idvisiteur' => $NUidVisiteur,'numAsso' => $NUnumAsso,
					'LibelleEcole' => $NULibelleEcole,'LibelleAsso' => $NULibelleAsso,'NbEtudiantEcole' => $NUNbEtudiantEcole,
					'NbPersonneAsso' => $NUNbPersonneAsso,'step'=>1)
					);
					$_SESSION['userconcours']=$wpdb->insert_id;
				}
				///Notify: inscrition succesfully 
			}
			
			$_SESSION['numAsso']=$NUnumAsso;
			$_SESSION['LibelleEcole']=$NULibelleEcole;
			$_SESSION['LibelleAsso']=$NULibelleAsso;
			$_SESSION['NbEtudiantEcole']=$NUNbEtudiantEcole;
			$_SESSION['NbPersonneAsso']=$NUNbPersonneAsso;
		
	
	}


function UpdateVisiteurInfo(){

		$ExidVisiteur =$_SESSION['ID'];
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
function getUserConcoursInfo(){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT cl.id,cl.NumAsso,cl.LibelleEcole,cl.LibelleAsso,cl.NbEtudiantEcole,cl.NbPersonneAsso
		FROM ste_UserConcours cl where idvisiteur=".$_SESSION['ID']);
	
		$_SESSION['userconcours']=$user[0]->id;
		$_SESSION['numAsso']=$user[0]->NumAsso;
		$_SESSION['LibelleEcole']=$user[0]->LibelleEcole;
		$_SESSION['LibelleAsso']=$user[0]->LibelleAsso;
		$_SESSION['NbEtudiantEcole']=$user[0]->NbEtudiantEcole;
		$_SESSION['NbPersonneAsso']=$user[0]->NbPersonneAsso;
		
		
}


get_footer();
?>