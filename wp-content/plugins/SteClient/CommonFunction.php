<?php
session_start();
function getListCivilites($id){

global $wpdb;
	$listOfCivilites = $wpdb->get_results(
	"SELECT ci.id,ci.label
	FROM ste_civilite ci");
	foreach ($listOfCivilites as $civilite){
		$Selected="";
		if(!empty($id) && $id==$civilite->id){
			$Selected="selected";
		}
		echo  "<option value=\"".$civilite->id."\"".$Selected.">".$civilite->label."</option> \n";
	}
}

function getListPays($id){
?>
<select name="listPays">
<?php
global $wpdb;
		$listOfPays = $wpdb->get_results(
		"SELECT id,Fr label
		FROM ste_Pays");
		foreach ($listOfPays as $pays){
			$Selected="";
			if(!empty($id) && $id==$pays->id){
				$Selected="selected";
			}
			echo  "<option value=\"".$pays->id."\"".$Selected.">".$pays->label."</option> \n";
		}
?>
</select></br>
<?php
}

function getListProfilEntreprise($id){
?>
<select name="listProfilEntreprise">
<?php
global $wpdb;
		$listProfilEntreprise = $wpdb->get_results(
		"SELECT id,label
		FROM ste_profilentreprise");
		foreach ($listProfilEntreprise as $profilEntreprise){
			$Selected="";
			if(!empty($id) && $id==$profilEntreprise->id){
				$Selected="selected";
			}
			echo  "<option value=\"".$profilEntreprise->id."\"".$Selected.">".$profilEntreprise->label."</option> \n";
		}
?>
</select></br>
<?php
}


function getListProfil($id){
?>
<select name="listProfilUser">
<?php
global $wpdb;
		$listProfilUser = $wpdb->get_results(
		"SELECT id,label
		FROM ste_profile");
		foreach ($listProfilUser as $profil){
			$Selected="";
			if(!empty($id) && $id==$profil->id){
				$Selected="selected";
			}
			echo  "<option value=\"".$profil->id."\"".$Selected.">".$profil->label."</option> \n";
		}
?>
</select></br>
<?php
}

function getListLangue($id){
?>
<select name="listLangue">
<?php
global $wpdb;
		$listLague = $wpdb->get_results(
		"SELECT id,label
		FROM ste_langue");
		foreach ($listLague as $langue){
			$Selected="";
			if(!empty($id) && $id==$langue->id){
				$Selected="selected";
			}
			echo  "<option value=\"".$langue->id."\"".$Selected.">".$langue->label."</option> \n";
		}
?>
</select></br>
<?php
}

function getListCategorieForPack($id){

global $wpdb;
		$listcategorie = $wpdb->get_results(
		"SELECT id,libelle
		FROM ste_categorie");
		foreach ($listcategorie as $categorie){
			$Selected="";
			if(!empty($id) && $id==$categorie->id){
				$Selected="selected";
			}
			echo  "<option value=\"".$categorie->id."\"".$Selected.">".$categorie->libelle."</option> \n";
		}
}

function EncryptPassword($strPlainText) {
 
  if (CRYPT_SHA512 != 1) {
    throw new Exception('Hashing mechanism not supported.');
  }
  return crypt($strPlainText, '$6$rounds=4567$abcdefghijklmnop$'); 
}

function validatePassword($strPlainText,$password) {
 
  if (CRYPT_SHA512 != 1) {
    throw new Exception('Hashing mechanism not supported.');
  }
  return (crypt($strPlainText, '$6$rounds=4567$abcdefghijklmnop$') == $password) ? true : false;
}

function Login()
{
    if(empty($_POST['email']))
    {
        return false;
    }
    if(empty($_POST['password']))
    {
        return false;
    }
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $result=CheckLoginInDB($email,$password);
    if($result==-1)
    {
        return false;
    }
	else{
		return true;
	}
}

function CheckLoginInDB($email,$password){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT c.id, c.email,c.password, c.userid,c.role
		FROM ste_connexion c where c.email='".$email."'");
		if(sizeof($user)==1){
			if(validatePassword($password,$user[0]->password)){
				$_SESSION['connexionID'] = $user[0]->id;
				$_SESSION['userRole'] = $user[0]->role;
				setUserInSession($user[0]->userid,$user[0]->role);
				return $user[0]->id;
			}
			else{

				return -1;
			}
		}
		else{
			return -1;
		}
}

function CheckLogin()
{
     //session_start();
     if(empty($_SESSION['connexionID']))
     {
        return false;
     }
     return true;
}
function logout(){
		session_destroy();
}
function connect(){
	if(!CheckLogin()){	
		if(!empty($_POST['email']) && !empty($_POST['password'])){
			if(Login()){
				echo 'ok';
			}
			else{
				echo 'notok';
			}
		}
		else{
			echo 'bad credentiel';
		}
	}
	else{
		echo "you are connected";
	}
}

function setUserInSession($id,$roleid){
	
	if($roleid==1){
		//User is Visiteur
		getVisiteurById($id);
	}
	else{
		//User is Exposant
		getExposantById($id);
	}
	
}

function getVisiteurById($id){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT v.id,v.civilite,v.nom,v.prenom,v.nomAsso,v.numAsso,v.ville,v.tel,v.adresse,v.codepostal,c.email
		FROM ste_visiteurs v, ste_connexion c where v.id=".$id." and v.id=c.userid and c.role=1");

		$_SESSION['ID']=$id;
		$_SESSION['civilite']=$user[0]->civilite;
		$_SESSION['nom']=$user[0]->nom;
		$_SESSION['prenom']=$user[0]->prenom;
		$_SESSION['nomAsso']=$user[0]->nomAsso;
		$_SESSION['numAsso']=$user[0]->numAsso;
		$_SESSION['email']=$user[0]->email;
		$_SESSION['ville']=$user[0]->ville;
		$_SESSION['tel']=$user[0]->tel;
		$_SESSION['adresse']=$user[0]->adresse;
		$_SESSION['codePostal']=$user[0]->codepostal;
		
		
}

function getExposantById($id){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT cl.civilite,cl.libelleEntreprise,cl.NumSiret,cl.SecteurActivite,cl.AdresseSiege,cl.CodePostal,cl.Ville,cl.nom,cl.prenom,cl.fonction,c.email
		FROM ste_exposants cl, ste_connexion c where cl.id=".$id." and cl.id=c.userid and c.role=2");
		
		$_SESSION['ID']=$id;
		$_SESSION['libelleEntreprise']=$user[0]->libelleEntreprise;
		$_SESSION['NumSiret']=$user[0]->NumSiret;
		$_SESSION['SecteurActivite']=$user[0]->SecteurActivite;
		$_SESSION['AdresseSiege']=$user[0]->AdresseSiege;
		$_SESSION['CodePostal']=$user[0]->CodePostal;
		$_SESSION['Ville']=$user[0]->Ville;
		$_SESSION['civilite']=$user[0]->civilite;
		$_SESSION['nom']=$user[0]->nom;
		$_SESSION['prenom']=$user[0]->prenom;
		$_SESSION['fonction']=$user[0]->fonction;
		$_SESSION['email']=$user[0]->email;
		
		
}

?>