<?php
function getListCivilites($id){
?>
<select name="ListCivilites">
<?php
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
?>
</select></br>
<?php
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
     
		session_start();
		$_SESSION['connexionID'] = $result;
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
     session_start();
      
     if(empty($_SESSION['connexionID']))
     {
        return false;
     }
     return true;
}
function logout(){
	if(!empty($_POST['logout'])){
		echo 'logout';
		session_start();
		session_destroy();
		exit();
	}
}
logout();
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
?>