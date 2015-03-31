<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
    <!-- Redirect browsers with JavaScript disabled to the origin page -->
    <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="fileupload-buttonbar">
        <div class="fileupload-buttons">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="fileinput-button">
                <span>Add files...</span>
                <input type="file" name="files[]" multiple>
            </span>
            <button type="submit" class="start">Start upload</button>
            <button type="reset" class="cancel">Cancel upload</button>
            <button type="button" class="delete">Delete</button>
            <input type="checkbox" class="toggle">
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="fileupload-progress fade" style="display:none">
            <!-- The global progress bar -->
            <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation"><tbody class="files"></tbody></table>
</form>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress"></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="start" disabled>Start</button>
            {% } %}
            {% if (!i) { %}
                <button class="cancel">Cancel</button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            {% if (file.error) { %}
                <div><span class="error">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
            <input type="checkbox" name="delete" value="1" class="toggle">
        </td>
    </tr>
{% } %}
</script>

<?php 

wp_enqueue_style('CssDemo', plugins_url('css/demo.css',__FILE__), array(), '2', true );
	wp_enqueue_style('Cssfileupload', plugins_url('css/jquery.fileupload.css',__FILE__), array(), '2', true );
	wp_enqueue_style('CssfileuploadUI', plugins_url('css/jquery.fileupload-ui.css',__FILE__), array(), '2', true );
	wp_enqueue_script('JSiframetransport', plugins_url('js/jquery.iframe-transport.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileupload', plugins_url('js/jquery.fileupload.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadProcess', plugins_url('js/jquery.fileupload-process.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadImage', plugins_url('js/jquery.fileupload-image.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadAudio', plugins_url('js/jquery.fileupload-audio.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadVideo', plugins_url('js/jquery.fileupload-video.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadValidate', plugins_url('js/jquery.fileupload-validate.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadUI', plugins_url('js/jquery.fileupload-ui.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSfileuploadJquery', plugins_url('js/jquery.fileupload-jquery-ui.js',__FILE__), array(), '2', true );
	wp_enqueue_script('JSMain', plugins_url('js/main.js',__FILE__), array(), '2', true );

?>