            <div id="formdiv">
                <h2>Multiple Image Upload Form</h2>
                <form enctype="multipart/form-data" action="" method="post">
                    First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
                    <hr/>
                    <div id="filediv">
						<div>
						<div id="Divf1"></div>
						<input name="file1" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre1" id="titre1"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre1" id="Soustitre1"/>
						<label>URL</label>
						<input type="text" name="url1" id="url1"/>
						</div><br>
						
						<div>
						<div id="Divf2"></div>
						<input name="file2" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre2" id="titre2"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre2" id="Soustitre2"/>
						<label>URL</label>
						<input type="text" name="url2" id="url2"/>
						</div><br>
						
						<div>
						<div id="Divf3"></div>
						<input name="file3" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre3" id="titre3"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre3" id="Soustitre3"/>
						<label>URL</label>
						<input type="text" name="url3" id="url3"/>
						</div><br>
						
						<div>
						<div id="Divf4"></div>
						<input name="file4" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre4" id="titre4"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre4" id="Soustitre4"/>
						<label>URL</label>
						<input type="text" name="url4" id="url4"/>
						</div><br>
						
						<div>
						<div id="Divf5"></div>
						<input name="file5" type="file" id="file"/>
						<label>Titre</label>
						<input type="text" name="titre5" id="titre5"/>
						<label>Sous Titre</label>
						<input type="text" name="Soustitre5" id="Soustitre5"/>
						<label>URL</label>
						<input type="text" name="url5" id="url5"/>
						</div><br>
					</div><br/>
           
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
					<input type="hidden" id="path" value="<?php echo plugins_url(); ?>" />
                </form>
                <br/>
                <br/>
				<!-------Including PHP Script here------>
				<?php include 'uploadSlider.php'; ?>
            </div>
