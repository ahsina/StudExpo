<?php
function getListOfVisiteursSTE(){
?>
<script>
$(document).ready(function() {

    $('#ListOfVisiteurs').dataTable( {
		"sDom": 'T<"clear">lfrtip',
        "order": [[ 2, "desc" ]],"columns": [ 
		{"name": "", "orderable": false},
		{"name": "Civilite", "orderable": true},
		{"name": "Nom", "orderable": true},
		{"name": "Pr&eacute;nom", "orderable": true},
		{"name": "Libelle de l'asso", "orderable": true},
		{"name": "N° de l'asso", "orderable": true},
		{"name": "Email", "orderable": true},
		{"name": "Telephone", "orderable": true},
		{"name": "ville", "orderable": true},
		{"name": "Adresse", "orderable": true,"visible": false,"searchable": false},
		{"name": "Code postal", "orderable": true,"visible": false,"searchable": false}]
    } );
	
} );
</script>
	<div class="wrap">
	<h2>Liste des Visiteurs StudExpo</h2>
	<div class="wrap">
	<span>
	<a class="button-primary" name="btnAdd" href="#">Ajouter</a>
	</span>
	<span>
	<form method="post" name="Modify-User">
	<input type="submit" class="button-secondary" name="btnModify" onClick="return getSelectedUser(this,null,'#ListOfVisiteurs','#idVisiteur','','','');" value="Modifier"/>
	<input type="hidden" name="idVisiteur" id="idVisiteur" />
	</form>
	</span>
	<span>
	<form method="post" name="Delete-User">
	<input type="submit" class="button-primary" name="btnDelete" onClick="return getListOfSelectedUser(this,'#ListOfVisiteurs','#idVisiteurs');" value="Supprimer"/>
	<input type="hidden" name="idVisiteurs" id="idVisiteurs" />
	</form>
	</span>
	<span>
	<a class="button-secondary" name="btnContact" onClick="return getSelectedUser(this,'#emailForm','#ListOfVisiteurs',null,6,2,3);" href="#">Contacter</a>
	</span>
	</div>
	<?php
	include 'Visiteur.php';
	include 'DeleteVisiteur.php';
	include 'ContactVisiteur.php';
	?>
	
	<div class="wrap">
	</br>
	<table id="ListOfVisiteurs" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th></th>
				<th>Civilite</th>
                <th>Nom</th>
                <th>Pr&eacute;nom</th>
                <th>Libelle de l'asso</th>
                <th>N° de l'asso</th>
                <th>Email</th>
                <th>Telephone</th>
				<th>Ville</th>
				<th>Adresse</th>
				<th>Code postal</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th>Civilite</th>
                <th>Nom</th>
                <th>Pr&eacute;nom</th>
                <th>Libelle de l'asso</th>
                <th>N° de l'asso</th>
                <th>Email</th>
                <th>Telephone</th>
				<th>Ville</th>
				<th>Adresse</th>
				<th>Code postal</th>
            </tr>
        </tfoot>
		<tbody>
            
<?php
		global $wpdb;
		$listOfUsers = $wpdb->get_results(
		"SELECT cl.id,ci.label,cl.nom,cl.prenom,cl.nomAsso,cl.numasso,c.email,cl.tel tel,cl.ville ville, cl.CodePostal codePostal,cl.Adresse adresse
		FROM ste_Visiteurs cl, ste_civilite ci ,ste_connexion c
		WHERE cl.civilite=ci.id and cl.id=c.userid");
		foreach ($listOfUsers as $Visiteur){
			?>
			<tr>
<?php
			echo "<td> <input type=\"checkbox\" value=\"".$Visiteur->id."\"/></td>";
			echo "<td>".$Visiteur->label."</td>";
			echo "<td>".$Visiteur->nom."</td>";
			echo "<td>".$Visiteur->prenom."</td>";
			echo "<td>".$Visiteur->nomAsso."</td>";
			echo "<td>".$Visiteur->numasso."</td>";
			echo "<td>".$Visiteur->email."</td>";
			echo "<td>".$Visiteur->tel."</td>";
			echo "<td>".$Visiteur->ville."</td>";
			echo "<td>".$Visiteur->codePostal."</td>";
			echo "<td>".$Visiteur->adresse."</td>";
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