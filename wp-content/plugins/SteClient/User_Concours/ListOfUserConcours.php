<?php
function getListOfUserConcoursSTE(){
?>
<script>
$(document).ready(function() {
    $('#ListOfUserConcours').dataTable( {
		"sDom": 'T<"clear">lfrtip',
        "order": [[ 2, "desc" ]],"columns": [ 
		{"name": "", "orderable": false},
		{"name": "Nom de l'ecole", "orderable": true},
		{"name": "Nom de l'asso", "orderable": true},
		{"name": "N° de l'asso", "orderable": true},
		{"name": "Nb d'etudiant de l'école", "orderable": true},
		{"name": "Nb d'etudiant de l'asso", "orderable": true},
		{"name": "Civilite", "orderable": true},
		{"name": "Nom", "orderable": true},
		{"name": "Pr&eacute;nom", "orderable": true},
		{"name": "Email", "orderable": true},
		{"name": "Telephone", "orderable": true,"visible": false,"searchable": false},
		{"name": "ville", "orderable": true,"visible": false,"searchable": false},
		{"name": "Adresse", "orderable": true,"visible": false,"searchable": false},
		{"name": "Code postal", "orderable": true,"visible": false,"searchable": false}]
    } );
	
} );
</script>
	<div class="wrap">
	<h2>Liste des participants au concours StudExpo</h2>
	<div class="wrap">
	<span>
	<a class="button-primary" name="btnAdd" href="#">Ajouter</a>
	</span>
	<span>
	<form method="post" name="Modify-User">
	<input type="submit" class="button-secondary" name="btnModify" onClick="return getSelectedUser(this,null,'#ListOfUserConcours','#idUserConcour','','','');" value="Modifier"/>
	<input type="hidden" name="idUserConcour" id="idUserConcour" />
	</form>
	</span>
	<span>
	<form method="post" name="Delete-User">
	<input type="submit" class="button-primary" name="btnDelete" onClick="return getListOfSelectedUser(this,'#ListOfUserConcours','#idUserConcours');" value="Supprimer"/>
	<input type="hidden" name="idUserConcours" id="idUserConcours" />
	</form>
	</span>
	<span>
	<a class="button-secondary" name="btnContact" onClick="return getSelectedUser(this,'#emailForm','#ListOfUserConcours',null,9,6,7);" href="#">Contacter</a>
	</span>
	</div>
	<?php
	include 'UserConcours.php';
	include 'DeleteUserConcours.php';
	include 'ContactUserConcours.php';
	?>
	
	<div class="wrap">
	</br>
	<table id="ListOfUserConcours" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th></th>
				<th>Nom de l'ecole</th>
				<th>Nom de l'asso</th>
				<th>N° de l'asso</th>
				<th>Nb d'etudiant de l'école</th>
				<th>Nb d'etudiant de l'asso</th>
				<th>Civilite</th>
				<th>Nom</th>
				<th>Pr&eacute;nom</th> 
				<th>Email</th>
				<th>Telephone</th>
				<th>ville</th>
				<th>Adresse</th>
				<th>Code postal</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th>Nom de l'ecole</th>
				<th>Nom de l'asso</th>
				<th>N° de l'asso</th>
				<th>Nb d'etudiant de l'école</th>
				<th>Nb d'etudiant de l'asso</th>
				<th>Civilite</th>
				<th>Nom</th>
				<th>Pr&eacute;nom</th> 
				<th>Email</th>
				<th>Telephone</th>
				<th>ville</th>
				<th>Adresse</th>
				<th>Code postal</th>
            </tr>
        </tfoot>
		<tbody>
            
<?php
		global $wpdb;
		$listOfUsers = $wpdb->get_results(
		"SELECT ci.label,cl.id,cl.nom,cl.prenom,cl.NumAsso,cl.email,cl.Tel,cl.Ville,cl.Adresse,cl.CodePostal,cl.LibelleEcole,cl.LibelleAsso,cl.NbEtudiantEcole,cl.NbPersonneAsso
		FROM ste_UserConcours cl, ste_civilite ci 
		WHERE cl.civilite=ci.id");
		foreach ($listOfUsers as $Visiteur){
			?>
			<tr>
<?php
			echo "<td> <input type=\"checkbox\" value=\"".$Visiteur->id."\"/></td>";
			echo "<td>".$Visiteur->LibelleEcole."</td>";
			echo "<td>".$Visiteur->LibelleAsso."</td>";
			echo "<td>".$Visiteur->NumAsso."</td>";
			echo "<td>".$Visiteur->NbEtudiantEcole."</td>";
			echo "<td>".$Visiteur->NbPersonneAsso."</td>";
			echo "<td>".$Visiteur->label."</td>";
			echo "<td>".$Visiteur->nom."</td>";
			echo "<td>".$Visiteur->prenom."</td>";
			echo "<td>".$Visiteur->email."</td>";
			echo "<td>".$Visiteur->Tel."</td>";
			echo "<td>".$Visiteur->Ville."</td>";
			echo "<td>".$Visiteur->Adresse."</td>";
			echo "<td>".$Visiteur->CodePostal."</td>";
?>
			</tr>
		
<?php
		}
?>
			
		</tbody>
		</table>
<?php
}

?>