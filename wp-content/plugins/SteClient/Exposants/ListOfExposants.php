<?php
function getListOfExposantsSTE(){
?>
<script>
$(document).ready(function() {
    $('#ListOfExposants').dataTable( {
		"sDom": 'T<"clear">lfrtip',
        "order": [[ 2, "desc" ]],"columns": [ 
		{"name": "", "orderable": false},
		{"name": "Nom de l'entreprise", "orderable": true},
		{"name": "N° de SIRET", "orderable": true},
		{"name": "Secteur d'activité", "orderable": true},
		{"name": "Adresse du siège social", "orderable": true,"visible": false,"searchable": false},
		{"name": "Code postal", "orderable": true,"visible": false,"searchable": false},
		{"name": "Ville", "orderable": true},
		{"name": "Civilite", "orderable": true},
		{"name": "Nom", "orderable": true},
		{"name": "Pr&eacute;nom", "orderable": true},
		{"name": "Fonction", "orderable": true},
		{"name": "Email", "orderable": true}
		]
    } );
} );
</script>
	<div class="wrap">
	<h2>Liste des Exposants StudExpo</h2>
	<div class="wrap">
	<span>
	<a class="button-primary" name="btnAdd" href="#">Ajouter</a>
	</span>
	<span>
	<form method="post" name="Modify-User">
	<input type="submit" class="button-secondary" name="btnModify" onClick="return getSelectedUser(this,null,'#ListOfExposants','#idExposant','','','');" value="Modifier"/>
	<input type="hidden" name="idExposant" id="idExposant" />
	</form>
	</span>
	<span>
	<form method="post" name="Delete-User">
	<input type="submit" class="button-primary" name="btnDelete" onClick="return getListOfSelectedUser(this,'#ListOfExposants','#idExposants');" value="Supprimer"/>
	<input type="hidden" name="idExposants" id="idExposants" />
	</form>
	</span>
	<span>
	<a class="button-secondary" name="btnContact" onClick="return getSelectedUser(this,'#emailForm','#ListOfExposants',null,9,6,7);" href="#">Contacter</a>
	</span>
	</div>
	<?php
	include 'Exposant.php';
	include 'DeleteExposant.php';
	include 'ContactExposant.php';
	?>
	
	<div class="wrap">
	</br>
	
	<table id="ListOfExposants" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th></th>
				<th>Nom de l'entreprise</th>
                <th>N° de SIRET</th>
                <th>Secteur d'activité</th>
                <th>Adresse du siège social</th>
                <th>Code postal</th>
                <th>Ville</th>
				<th>Civilite</th>
                <th>Nom</th>
				<th>Prénom</th>
				<th>Fonction</th>
				<th>Email</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th>Nom de l'entreprise</th>
                <th>N° de SIRET</th>
                <th>Secteur d'activité</th>
                <th>Adresse du siège social</th>
                <th>Code postal</th>
                <th>Ville</th>
				<th>Civilite</th>
                <th>Nom</th>
				<th>Prénom</th>
				<th>Fonction</th>
				<th>Email</th>
            </tr>
        </tfoot>
		<tbody>
            
<?php
		global $wpdb;
		$listOfUsers = $wpdb->get_results(
		"SELECT ci.label,cl.id,cl.libelleEntreprise,cl.NumSiret,cl.SecteurActivite,cl.AdresseSiege,cl.CodePostal,cl.Ville,cl.nom,cl.prenom,cl.fonction,c.email
		FROM ste_exposants cl, ste_civilite ci ,ste_connexion c 
		WHERE cl.civilite=ci.id and cl.id=c.userid and c.role=2");
		foreach ($listOfUsers as $Exposant){
			?>
			<tr>
<?php
echo "<td> <input type=\"checkbox\" value=\"".$Exposant->id."\"/></td>";
echo "<td>".$Exposant->libelleEntreprise."</td>";
echo "<td>".$Exposant->NumSiret."</td>";
echo "<td>".$Exposant->SecteurActivite."</td>";
echo "<td>".$Exposant->AdresseSiege."</td>";
echo "<td>".$Exposant->CodePostal."</td>";
echo "<td>".$Exposant->Ville."</td>";
echo "<td>".$Exposant->label."</td>";
echo "<td>".$Exposant->nom."</td>";
echo "<td>".$Exposant->prenom."</td>";
echo "<td>".$Exposant->fonction."</td>";
echo "<td>".$Exposant->email."</td>";
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