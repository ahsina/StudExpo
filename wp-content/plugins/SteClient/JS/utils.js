function getSelectedUser(object,formId,tablename,inputID,posEmail,posNom,posPrenom){
	var selected =$(tablename).find('input[type="checkbox"]:checked');
	if(formId==null){
		if(object.name=="btnModify"){
			if(selected.length!=1){
				alert("Veuillez choisir un seul client du tableau");
				return false;
			}
			else
			{
				$(inputID).val(selected[0].value);
				return true;
			}
			
		}
	}
	else if(formId=='#emailForm'){
			if(selected.length==1){
				ShowDiv(formId);
				$(tablename).find('tr').each(function () {
					var row = $(this);
					if (row.find('input[type="checkbox"]').is(':checked')){
						$('#emailForm').find('#idClient').val(selected[0].value);
						$('#emailForm').find('#InfoContact').text(row.children().eq(posNom).text().toUpperCase()+' '+row.children().eq(posPrenom).text() +' <'+row.children().eq(posEmail).text()+'>');
						$('#emailForm').find('#email').val(row.children().eq(posEmail).text());
					}
				});
				
			}
			else{
				alert("Veuillez choisir un seul client du tableau");
			}
	}
	
}

function getListOfSelectedUser(object,tablename,inputId){
	var selected =$(tablename).find('input[type="checkbox"]:checked');
	if(object.name=="btnDelete"){
		if(selected.length==0){
			alert("Veuillez choisir un seul client du tableau");
			return false;
		}
		else
		{
			var ids = "";
			for (var i = 0; i<selected.length; i++) {
					ids+=selected[i].value +"/";
			};
			$(inputId).val(ids);
			return true;
		}
		
	}
	
}

function CloseDiv(divID){
	$(divID).hide();
	return false;
}

function ShowDiv(divID){
	$(divID).show();
	return false;
}
function getSelectedItemList(selectName,SelectWhereAdd){
var selectid=selectName+" :selected";
	$(selectid).each(function(i, selectedElement) {
		$(SelectWhereAdd).append('<option value=\"'+$(selectedElement).val()+'\">'+$(selectedElement).text()+'</option>');
	});
}

function removeSelectedItemList(selectName){
var selectid=selectName+" :selected";
	$(selectid).each(function(i, selectedElement) {
		selectedElement.remove();
	});
}