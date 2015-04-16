<?php
if (isset($_POST['submit'])) {
	if ($_FILES['file1']['size'] != 0){
		$fileName=upload('file1');
		if($fileName!=-1){
			addSliderImage(1,$fileName,$_POST['titre1'],$_POST['Soustitre1'],$_POST['url1']);
		}
	}
	if ($_FILES['file2']['size'] != 0){
		$fileName=upload('file2');
		if($fileName!=-1){
			addSliderImage(2,$fileName,$_POST['titre2'],$_POST['Soustitre2'],$_POST['url2']);
		}
	}
	if ($_FILES['file3']['size'] != 0){
		$fileName=upload('file3');
		if($fileName!=-1){
			addSliderImage(3,$fileName,$_POST['titre3'],$_POST['Soustitre3'],$_POST['url3']);
		}
	}
	if ($_FILES['file4']['size'] != 0){
		$fileName=upload('file4');
		if($fileName!=-1){
			addSliderImage(4,$fileName,$_POST['titre4'],$_POST['Soustitre4'],$_POST['url4']);
		}
	}
	if ($_FILES['file5']['size'] != 0){
		$fileName=upload('file5');
		if($fileName!=-1){
			addSliderImage(5,$fileName,$_POST['titre5'],$_POST['Soustitre5'],$_POST['url5']);
		}
	}
}
else{
	//Load Data
}
function upload($name){
	$j = 0; //Variable for indexing uploaded image 
	$target_path = 'D:/Program Files (x86)/EasyPHP-DevServer-14.1VC11/data/localweb/projects/StudExpo/wp-content/plugins/GestionContenu/uploads/'; //Declaring Path for uploaded images
	echo $target_path;

			$validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
			$ext = explode('.', basename($_FILES[$name]['name']));//explode file name from dot(.) 
			$file_extension = end($ext); //store extensions in the variable
			
			$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
			$j = $j + 1;//increment the number of uploaded images according to the files in array       
		  
		  if (($_FILES[$name]["size"] < 1000000000) //Approx. 100kb files can be uploaded.
					&& in_array($file_extension, $validextensions)) {
				if (move_uploaded_file($_FILES[$name]['tmp_name'], $target_path)) {//if file moved to uploads folder
					echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
					return $target_path;
				} else {//if file was not moved.
					echo $j. ').<span id="error">please try again!.</span><br/><br/>';
					return -1;
				}
			} else {//if file size and file type was incorrect.
				echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
				return -1;
			}

}

function addSliderImage($NId,$NImage,$NTitre,$NSousTitre,$NUrl){

	global $wpdb;
				$resut=$wpdb->insert( 
				'ste_slider', 
				array('id' => $NId,'image' => $NImage,'titre' => $NTitre, 'sousTitre' =>$NSousTitre,
				'url' => $NUrl)
				);
			//Notify Save Slider
}
?>