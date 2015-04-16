var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file	
$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				var idDivImg= '#Divf'+this.name.replace("file", "");
				var z = abc - 1;
                //var x = $(this).parent().find('#previewimg' + z).remove();
				$(idDivImg).html("<img style='width:200px;height:150px' id='previewimg" + abc + "' src=''/>");
                //$(this).before("<div id='abcd"+ abc +"' class='abcd'><img style='width:200px;height:150px' id='previewimg" + abc + "' src=''/></div>");
               var nameFileInput=this.name;
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               var directory = $("#path").val();
			    $(this).hide();
                $(idDivImg).append($("<img/>", {id: 'img', src: directory+'/GestionContenu/img/x.png', alt: 'delete'}).click(function() {
                $(idDivImg).empty();
				$('[name="'+nameFileInput+'"]').show();
				$('[name="'+nameFileInput+'"]').replaceWith($('[name="'+nameFileInput+'"]').val('').clone(true));
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});