<div name="emailForm" id="emailForm" style="display:none">
<form method="post" name="AddNewUser">
<input type="hidden" id="idClient" name="idClient"/>
<label>contact</label><span name="InfoContact" id="InfoContact"></span></br>
<input type="hidden" name="email" id="email"/>
<label>Sujet</label><input type="text" name="sujet" id="sujet"/></br>
<label>Corps</label><textarea name="corps"  id="corps" rows="15" cols="50"></textarea></br>
<input type="submit" class="button-primary"  value="Envoyer" name="sendEmail"/>
<a href="#" id="closingEmail" class="button-secondary"  onclick="return CloseDiv('#emailForm');">Close</a>
</form>
</div>

<?php
if(!empty($_POST['idClient']) && !empty($_POST['sujet']) && !empty($_POST['corps']) ){

	global $wpdb;
		$listOfUsers = $wpdb->get_results(
		"SELECT email
		FROM ste_UserConcours 
		WHERE id="+$_POST['idClient']);
		$ContactEmails = $wpdb->get_results(
		"SELECT email 
		FROM ste_emailStud 
		WHERE id=1");
		$headers = 'From: My Name <'.$ContactEmail[0]->email.'>' . "\r\n";
		$mail=wp_mail( $listOfUsers[0]->email, $_POST['sujet'], $_POST['corps'],$headers );
		///Notify: Email succesfully sent
}
?>