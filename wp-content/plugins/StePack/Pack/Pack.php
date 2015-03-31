<?php 	
	function addNewPack(){
		if (empty($_POST['idV'])) {
			$NUlibelle = $_POST['libelle'];
			$NUsuperficie = $_POST['superficie'];
			$NUprixSA = $_POST['prixSA'];
			$NUprixSN = $_POST['prixSN'];
			$NUNbPack=$_POST['NbPack'];
			$NUdisponibilite = $_POST['disponibilite'];
			$NUcaracteristique = $_POST['caracteristiqueToAdd'];
			
			if(!empty($NUlibelle) && !empty($NUsuperficie) && !empty($NUprixSA) &&
			!empty($NUprixSN) && !empty($NUNbPack) && !empty($NUdisponibilite) && !empty($NUcaracteristique)){
				global $wpdb;
				$resut=$wpdb->insert( 
				'ste_pack', 
				array('id' => NULL,'libelle' => $NUlibelle,'superficie' => $NUsuperficie, 'prix_sa' =>$NUprixSA,
				'prix_sn' => $NUprixSN, 'NbPack' => $NUNbPack, 'disponibilite' => $NUdisponibilite)
				);
				$wpdb->insert( 
				'ste_pack', 
				array('id' => NULL,'libelle' => $NUlibelle,'superficie' => $NUsuperficie, 'prix_sa' =>$NUprixSA,
				'prix_sn' => $NUprixSN, 'NbPack' => $NUNbPack, 'disponibilite' => $NUdisponibilite)
				);
				/* $wpdb->insert( 
					'ste_connexion', 
					array('id' => NULL, 'email' => $NUemail,'password' => $Password,'role'=>1,'userid'=>$wpdb->insert_id)
				); */
				///Notify: user succesfully Added
			}

		}
	
	}

	function getPackID(){
		echo $_SESSION['ID'];
	}
	function getPackLibelle(){
		echo $_SESSION['MUlibelle'];
	}
	function getPackSuperficie(){
		echo $_SESSION['MUsuperficie'];
	}
	function getPackPrix_SA(){
		echo $_SESSION['MUprix_SA'];
	}
	function getPackPrix_SN(){
		echo $_SESSION['MUprix_SN'];
	}
	function getPackNbPack(){
		echo $_SESSION['MUNbPack'];
	}
	function getPackDisponibilite(){
		echo $_SESSION['MUdisponibilite'];
	}
	
if (!empty($_POST['idPack'])) {
	$idPack=$_POST['idPack'];
	getPackInfo($idPack);
}
$_SESSION['listofcategorie']=$_POST['listofcategorie'];
function getListofCaracteristiqueByCategorie(){
	if(!empty($_POST['listofcategorie'])){
		global $wpdb;
		$listcaracteristique = $wpdb->get_results(
		"SELECT c.id,c.libelle,c.prix
		FROM ste_caracteristique c, ste_categorie cat 
		WHERE c.idcategorie=cat.id and cat.id=".$_POST['listofcategorie']);
		foreach ($listcaracteristique as $caracteristique){

			echo "<option value='".$caracteristique->id."'>".$caracteristique->libelle."</option>";
		}
	}	
}
	
?>

<?php
	
function getPackInfo($id){
		global $wpdb;
		$user = $wpdb->get_results(
		"SELECT p.id,p.libelle,p.superficie,p.prix_SA,p.prix_SN,p.NbPack,p.disponibilite
		FROM ste_pack p where p.id=".$id);

		$_SESSION['ID']=$id;
		$_SESSION['MUlibelle']=$user[0]->libelle;
		$_SESSION['MUsuperficie']=$user[0]->superficie;
		$_SESSION['MUprix_SA']=$user[0]->prix_SA;
		$_SESSION['MUprix_SN']=$user[0]->prix_SN;
		$_SESSION['MUNbPack']=$user[0]->NbPack;
		$_SESSION['MUdisponibilite']=$user[0]->disponibilite;
		
		
}
function UpdatePackInfo(){
	if (!empty($_POST['idV'])) {
		$ExidPack =$_POST['idV'];
		$Exlibelle = $_POST['libelle'];
		$Exsuperficie = $_POST['superficie'];
		$ExprixSA = $_POST['prixSA'];
		$ExprixSN = $_POST['prixSN'];
		$ExNbPack=$_POST['NbPack'];
		$Exdisponibilite = $_POST['disponibilite'];
		if(!empty($Exlibelle) && !empty($Exsuperficie) && !empty($ExprixSA) 
		&& !empty($ExprixSN) && !empty($ExNbPack) && !empty($Exdisponibilite)){
			
			global $wpdb;
			$result=$wpdb->update( 
				'ste_visiteurs', 
				array('libelle' => $Exlibelle,'superficie' => $Exsuperficie, 'prixSA' =>$ExprixSA,
			'prixSN' => $ExprixSN, 'NbPack' => $ExNbPack, 'disponibilite' => $Exdisponibilite)
			,array( 'id' => $ExidPack)
			);			
		}
	
		//reactualiser les données de l'utilisateur
		$_SESSION['ID']=$ExidPack;
		$_SESSION['MUlibelle']=$Exlibelle;
		$_SESSION['MUsuperficie']=$Exsuperficie;
		$_SESSION['MUprix_SA']=$ExprixSA;
		$_SESSION['MUprix_SN']=$ExprixSN;
		$_SESSION['MUNbPack']=$ExNbPack;
		$_SESSION['MUdisponibilite']=$Exdisponibilite;
		///Notify: user succesfully updated
	}
}

function getListofCaracteristiqueByIds($idsPack){
	echo 'zeb '. SizeOf($idsPack);
	foreach ($idsPack as $id){
	global $wpdb;
		$Caracteristique = $wpdb->get_results(
		"SELECT id,libelle,prix,idcategorie
		FROM ste_caracteristique where id=".$id);
		echo '<option value="'.$Caracteristique[0]->id.'">'.$Caracteristique[0]->libelle.'</option>';
	}
}
UpdatePackInfo();
addNewPack();
?>
<form method="post" name="Packform">
<div class="wrap">
	<input type="hidden" name="idV" value="<?php if(!empty($idPack)){ echo $idPack;};?>"/>
	<div>
		<label>Libelle</label>
		<input type="text" name="libelle" 
		value="<?php if(!empty($idPack)){
						getPackLibelle();
						}?>"/>
	</div>
	
	<div style="width:100%">
		<label>Superficie</label>
		<input type="text" name="superficie" 
		value="<?php if(!empty($idPack)){
						getPackSuperficie();
						}?>"/>

		<label>Prix SA</label>
		<input type="text" name="prixSA" 
		value="<?php if(!empty($idPack)){
						getPackPrix_SA(); 
						}?>"/>
	</div>
	<div style="width:100%">
		<label>Prix SN</label>
		<input type="text" name="prixSN" 
		value="<?php if(!empty($idPack)){
						getPackPrix_SN();
						} ?>"/>
						
		<label>Nombre de pack</label>
		<input type="text" name="NbPack" 
		value="<?php if(!empty($idPack)){
						getPackNbPack(); 
						}?>"/>
	</div>
	
	<div>
		<label>Disponibilité</label>
		<input type="text" name="disponibilite" 
			value="<?php if(!empty($idPack)){
							getPackDisponibilite(); 
							}?>"/>
	</div>
	<div>
		<label>Categorie</label>
		<select name="listofcategorie" onchange="Packform.submit();">
		<option value="0">Selectionnez</option>
			<?php getListCategorieForPack($_SESSION['listofcategorie']); ?>
		</select>
	</div>
	<div>
		<div style="display: block;float: left;">
		<label>Selectionnez des Eléments</label>
		<select name="caracteristique[]" id="caracteristique" multiple="multiple" style="width:200px;">
			<?php getListofCaracteristiqueByCategorie($_POST['listofcategorie']); ?>
		</select>
		</div>
		<div style="display: block;float: left;">
		<input type="button" value=">" onclick="return getSelectedItemList('#caracteristique','#caracteristiqueToAdd');"/></br>
		<input type="button" value="<" onclick="return removeSelectedItemList('#caracteristiqueToAdd');"/></br>
		</div>
		<div style="display: block;">
		<label>Element du nouveau Pack</label>
		<select multiple name="vari[]">
		<option value="adriana">Adriana</option>
      <option value="alessandra">Alessandra</option>
      <option value="candice">Candice</option>
      <option value="lili">Lili</option>
			<?php if(!empty($_POST['caracteristique'])){
					echo '<script language="Javascript">
alert ("coucou." )
</script>';
					echo getListofCaracteristiqueByIds($_POST['vari']);
					}?>
		</select>
		</div>
	</div>
	
<div class="wrap">
<input type="submit" value="Enregistrer" name="user-update" class="button-primary"/>
<a href="#" class="button-secondary"> Annuler</a>
</div>
</form>