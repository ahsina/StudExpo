<?php
function getListOfPackSTE(){
?>
<script>
$(document).ready(function() {

    $('#ListOfPack').dataTable( {
		"sDom": 'T<"clear">lfrtip',
        "order": [[ 1, "desc" ]],"columns": [ 
		{"name": "", "orderable": false},
		{"name": "Libelle", "orderable": true},
		{"name": "Superficie (m2)", "orderable": true},
		{"name": "Prix SA", "orderable": true},
		{"name": "Prix SN", "orderable": true},
		{"name":"Nombre de pack","orderable":true},
		{"name": "Disponibilité", "orderable": true}
		]
    } );
	
} );
</script>
	<div class="wrap">
	<h2>Configurateur de pack StudExpo</h2>
	<div class="wrap">
	<span>
	<a class="button-primary" name="btnAdd" href="#">Ajouter</a>
	</span>
	<span>
	<form method="post" name="Modify-Pack">
	<input type="submit" class="button-secondary" name="btnModify" onClick="return getSelectedUser(this,null,'#ListOfPack','#idPack','','','');" value="Modifier"/>
	<input type="hidden" name="idPack" id="idPack" />
	</form>
	</span>
	<span>
	<form method="post" name="Delete-Pack">
	<input type="submit" class="button-primary" name="btnDelete" onClick="return getListOfSelectedUser(this,'#ListOfPack','#idPacks');" value="Supprimer"/>
	<input type="hidden" name="idPacks" id="idPacks" />
	</form>
	</span>
	</div>
	<?php
	include 'Pack.php';
	// include 'DeleteVisiteur.php';
	// include 'ContactVisiteur.php';
	?>
	
	<div class="wrap">
	</br>
	<table id="ListOfPack" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th></th>
				<th>Libelle</th>
				<th>Superficie (m2)</th>
                <th>Prix SA</th>
                <th>Prix SN</th>
                <th>Nombre de pack</th>
                <th>Disponibilité</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th>Libelle</th>
				<th>Superficie (m2)</th>
				<th>Prix SA</th>
				<th>Prix SN</th>
				<th>Nombre de pack</th>
				<th>Disponibilité</th>
            </tr>
        </tfoot>
		<tbody>
            
<?php
		global $wpdb;
		$listOfPacks = $wpdb->get_results(
		"SELECT cl.id,cl.libelle,cl.superficie,cl.prix_SN,cl.prix_SA,cl.NbPack,cl.disponibilite
		FROM ste_pack cl");
		foreach ($listOfPacks as $Pack){
			?>
			<tr>
<?php
			echo "<td> <input type=\"checkbox\" value=\"".$Pack->id."\"/></td>";
			echo "<td>".$Pack->libelle."</td>";
			echo "<td>".$Pack->superficie."</td>";
			echo "<td>".$Pack->prix_SN."</td>";
			echo "<td>".$Pack->prix_SA."</td>";
			echo "<td>".$Pack->NbPack."</td>";
			echo "<td>".$Pack->disponibilite."</td>";
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