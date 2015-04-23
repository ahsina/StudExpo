            <div id="formdiv">
                <h2>Gestionnaire de SLIDER</h2>
                <form enctype="multipart/form-data" action="" method="post">
                    Seul les exstensions JPEG,PNG,JPG Type sont autorisés. Taille d'image ne doit pas depassé 100KB.
                    <hr/>
					<!-------Including PHP Script here------>
					<?php include 'uploadSlider.php'; ?>
                    <div id="filediv">
						<div>
						<div id="Divf1">
						<?php
							$S1=getExistingSliderByID(1);
							if(!empty($S1[1])){
								echo '<img style="width:200px;height:150px" src="'.plugins_url( $S1[1], __FILE__ ).'"/>';
								echo '<img id="img" onclick="clearimage(\'Divf1\');" src="'.plugins_url( "/img/x.png", __FILE__ ).'" alt="delete">';
							}
						?>
						</div>
						<?php echo '<input type="hidden" value="'.$S1[0].'" name="idf1"/>'; ?>
						<input name="file1" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre1" id="titre1" value="<?php echo $S1[2]?>"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre1" id="Soustitre1" value="<?php echo $S1[3]?>"/>
						<label>URL</label>
						<input type="text" name="url1" id="url1" value="<?php echo $S1[4]?>"/>
						</div><br>
						
						<div>
						<div id="Divf2">
						<?php
							$S2=getExistingSliderByID(2);
							if(!empty($S2[1])){
								echo '<img style="width:200px;height:150px" src="'.plugins_url( $S2[1], __FILE__ ).'"/>';
								echo '<img id="img" onclick="clearimage(\'Divf2\');" src="'.plugins_url( "/img/x.png", __FILE__ ).'" alt="delete">';
							}
						?>
						</div>
						<?php echo '<input type="hidden" value="'.$S2[0].'" name="idf2"/>';?>
						<input name="file2" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre2" id="titre2" value="<?php echo $S2[2]?>"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre2" id="Soustitre2" value="<?php echo $S2[3]?>"/>
						<label>URL</label>
						<input type="text" name="url2" id="url2" value="<?php echo $S2[4]?>"/>
						</div><br>
						
						<div>
						<div id="Divf3">
						<?php
							$S3=getExistingSliderByID(3);
							if(!empty($S3[1])){
								echo '<img style="width:200px;height:150px" src="'.plugins_url( $S3[1], __FILE__ ).'"/>';
								echo '<img id="img" onclick="clearimage(\'Divf3\');" src="'.plugins_url( "/img/x.png", __FILE__ ).'" alt="delete">';
							}
						?>
						</div>
						<?php echo '<input type="hidden" value="'.$S3[0].'" name="idf3"/>'; ?>
						<input name="file3" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre3" id="titre3" value="<?php echo $S3[2]?>"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre3" id="Soustitre3" value="<?php echo $S3[3]?>"/>
						<label>URL</label>
						<input type="text" name="url3" id="url3" value="<?php echo $S3[4]?>"/>
						</div><br>
						
						<div>
						<div id="Divf4">
						<?php
							$S4=getExistingSliderByID(4);
							if(!empty($S4[1])){
								echo '<img style="width:200px;height:150px" src="'.plugins_url( $S4[1], __FILE__ ).'"/>';
								echo '<img id="img" onclick="clearimage(\'Divf4\');" src="'.plugins_url( "/img/x.png", __FILE__ ).'" alt="delete">';
							}
						?>
						</div>
						<?php echo '<input type="hidden" value="'.$S4[0].'" name="idf4"/>'; ?>
						<input name="file4" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre4" id="titre4" value="<?php echo $S4[2]?>"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre4" id="Soustitre4" value="<?php echo $S4[3]?>"/>
						<label>URL</label>
						<input type="text" name="url4" id="url4" value="<?php echo $S4[4]?>"/>
						</div><br>
						
						<div>
						<div id="Divf5">
						<?php
							$S5=getExistingSliderByID(5);
							if(!empty($S5[1])){
								echo '<img style="width:200px;height:150px" src="'.plugins_url( $S5[1], __FILE__ ).'"/>';
								echo '<img id="img" onclick="clearimage(\'Divf5\');" src="'.plugins_url( "/img/x.png", __FILE__ ).'" alt="delete">';
							}
						?>
						</div>
						<?php echo '<input type="hidden" value="'.$S5[0].'" name="idf5"/>'; ?>
						<input name="file5" type="file" id="file" value="<?php echo $S5[2]?>"/>
						<label>Titre</label>
						<input type="text" name="titre5" id="titre5" value="<?php echo $S5[3]?>"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre5" id="Soustitre5" value="<?php echo $S5[4]?>"/>
						<label>URL</label>
						<input type="text" name="url5" id="url5" value="<?php echo $S5[5]?>"/>
						</div><br>
					</div><br/>
           
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
					<input type="hidden" id="path" value="<?php echo plugins_url(); ?>" />
                </form>
                <br/>
                <br/>
            </div>
