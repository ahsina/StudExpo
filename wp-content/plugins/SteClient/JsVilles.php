<?php 

	function getListVilles($query){
		$link = mysql_pconnect("localhost", "root", "") or die("Could not connect");
		mysql_select_db("studexpo") or die("Could not select database");
		$arr = array();
		$rs = mysql_query("SELECT v.id idVille,v.nom_ville_maj Ville,v.code_postal cp,d.id_departement idDepartement ,
							d.nom_departement departement,r.id_region idRegion,r.nom_region region 
							FROM villes v, departement d, region r where 
							v.departement = d.code and d.id_region=r.id_region
							and (LOWER(v.nom_ville_maj) like '%".$query."%' or v.code_postal like '%".$query."%')");
		 
		while($obj = mysql_fetch_object($rs)) {
		$arr[] = $obj;
		}
		echo '{"villes":'.json_encode($arr).'}';
	}
	
if(!empty($_GET['query']){
	getListVilles($_GET['query']);
}
?>