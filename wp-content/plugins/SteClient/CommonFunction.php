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
?>