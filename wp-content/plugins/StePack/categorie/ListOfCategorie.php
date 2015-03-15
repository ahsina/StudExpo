<?php
include 'Caracteristique.php';
setCategorie();
addCategorie();
addnewCaracteristique();
ModifyCaracteristique();
DeleteCaracteristique();
if (!empty($_POST['idCaracteristique'])) {
	$idCaracteristique=$_POST['idCaracteristique'];
	getCaracteristiqueInfo($idCaracteristique);
}
function getListOfCaracteristiqueSTE(){
?>
<script>
$(document).ready(function() {
    $('#ListOfCaracteristique').dataTable( {
		"sDom": 'T<"clear">lfrtip',
        "order": [[ 2, "desc" ]],"columns": [ 
		{"name": "", "orderable": false},
		{"name": "Libelle", "orderable": true},
		{"name": "Prix", "orderable": true}
		]
    } );
} );
</script>
	<div class="wrap">
	<h2>Gestion des categories</h2>
	<div>
	<h3>Ajouter une categorie</h3>
		<form method="post" name="AddCategorie">
			<label>Libelle</label>
			<input type="text" name="categorieLabel"  />
			<input type="submit" class="button-primary" name="btnAddcategorie" value="Ajouter"/>
		</form>
	</div>
	</br>
	<div class="wrap">
	<h2>Gestion des caracteristiques</h2>
	<h3>Selectionnez une categorie</h3>
	<form name="changecategorie" method="post">
	<label>categorie</label>
	<select name="listofcategorie" onchange="changecategorie.submit();">
		<option value="0">Selectionnez</option>
	<?php getListCategorieForPack($_SESSION['listofcategorie']); ?>
	</select>
	</form>
	</br>
	<span>
	<a class="button-primary" name="btnAdd" href="#">Ajouter</a>
	</span>
	<span>
	<form method="post" name="Modify-User">
	<input type="submit" class="button-secondary" name="btnModify" onClick="return getSelectedUser(this,null,'#ListOfCaracteristique','#idC','','','');" value="Modifier"/>
	<input type="hidden" name="idCaracteristique" id="idC" />
	<input type="hidden" name="listofcategorie" id="listofcategorie" value=<?php echo $_SESSION['listofcategorie']; ?> />
	</form>
	</span>
	<span>
	<form method="post" name="Delete-User">
	<input type="submit" class="button-primary" name="btnDelete" onClick="return getListOfSelectedUser(this,'#ListOfCaracteristique','#idR');" value="Supprimer"/>
	<input type="hidden" name="idCaracteristiques" id="idR" />
	<input type="hidden" name="listofcategorie" id="listofcategorie" value=<?php echo $_SESSION['listofcategorie']; ?> />
	</form>
	</span>
	</div>
	<div>
		<form name="caracteristique-form" method="post">
			<input type="hidden" name="idCaM" id="idCaracteristique" 
			value="<?php if(!empty($_POST['idCaracteristique']))
						{
							getCaracteristiqueID();
						}?>" />
			<input type="hidden" name="listofcategorie" id="idCategorie" 
			value="<?php if(!empty($_POST['idCaracteristique']))
						{
							getCaracteristiqueCategorie();
						}
						else{
							echo $_SESSION['listofcategorie'];
						}?>" />
			<label>Libelle</label><input type="text" name="caracteristiqueLabel" 
			value="<?php if(!empty($_POST['idCaracteristique']))
						{
							getCaracteristiqueLibelle();
						}?>" />
			<label>Prix</label><input type="text" name="caracteristiquePrix"
			value="<?php if(!empty($_POST['idCaracteristique']))
						{
							getCaracteristiquePrix();
						}?>" />			
			<input type="submit" value="Enregistrer" name="user-update" class="button-primary"/>
			<a href="#" class="button-secondary">Annuler</a>			
		</form>
	</div>
	
	<div class="wrap">
	</br>
	
	<table id="ListOfCaracteristique" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th></th>
				<th>Libelle</th>
                <th>Prix</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th>Libelle</th>
                <th>Prix</th>
            </tr>
        </tfoot>
		<tbody>
<?php           
	getListCaracteristiqueOfcategorie();
?>		
		</tbody>
		</table>
<?php
}
function addCategorie(){
	if (!empty($_POST['btnAddcategorie']) && !empty($_POST['categorieLabel'])) {
		$NULibelle = $_POST['categorieLabel'];
		global $wpdb;
			$resut=$wpdb->insert( 
			'ste_categorie', 
			array('id' => NULL,'libelle' => $NULibelle)
			);
			///Notify: Categorie succesfully Added
	}
}
function setCategorie(){
	$_SESSION['listofcategorie']=$_POST['listofcategorie'];
}
function getListCaracteristiqueOfcategorie(){
	if(!empty($_POST['listofcategorie'])){
		
		global $wpdb;
		$listcaracteristique = $wpdb->get_results(
		"SELECT c.id,c.libelle,c.prix
		FROM ste_caracteristique c, ste_categorie cat 
		WHERE c.idcategorie=cat.id and cat.id=".$_POST['listofcategorie']);
		foreach ($listcaracteristique as $caracteristique){
			?>
			<tr>
<?php
			echo "<td> <input type=\"checkbox\" value=\"".$caracteristique->id."\"/></td>";
			echo "<td>".$caracteristique->libelle."</td>";
			echo "<td>".$caracteristique->prix."</td>";
		}
?>
			</tr>
		
<?php
	}
}
?>