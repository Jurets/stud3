var old_num = 0;
var old_cur = 0;
var old_name = '';
var old_cont = 0;

function htmlspecialchars(str) {
	return str;
	return str.replace(new RegExp("['|\"|&]", "g"), function(f) {
		switch (f) {
			case '"':
				return "&quot;";
			case "'":
				return "&#039;";
			case "&":
				return "&amp;";
		}
	});
}
function rename(num,cur,name,cont,logins){
	td = document.getElementById('li_folder'+num);
	if (old_num > 0){
	  resetfld(old_num,old_cur,old_name,old_cont)
	}
	td.innerHTML = GetForm(num,cur,name,cont);
	old_num = num;
	old_cur = cur;
	old_name = name;
	old_cont = cont;
}
function resetfld(num,cur,name,cont)
{
	td1 = document.getElementById('li_folder'+num);

  	folder_html = '';
  	if (num == cur)
  	{
  	  folder_html = "<i class=\"icon-folder-open\"></i> "+name;
  	}
  	else
  	{
  	  folder_html = '<i class=\"icon-folder-open\"></i> <a href="/contacts/?group_id='+num+'" class="blue">'+(name)+'</a>';
  	} 
  	folder_html = folder_html+" (<span id=\"fldcount"+num+"\">"+cont+"<\/span>)";
  	folder_html = folder_html+"<div style=\"margin-top: 7px;\" align=\"right\"><a href=\"\/contacts\/?action=delfolder&id="+num+"\">Удалить</a> | <a href=\"javascript:rename('"+num+"','"+cur+"','"+htmlspecialchars(name)+"','"+cont+"');\">Переименовать<\/a><\/div><div style=\"clear:both;\"></div>";

	td1.innerHTML = folder_html;
}
function submitRnFolderForm()
{


	id = $('#id').val();

	name = $('#new_name').val();


	$.ajax({
		type: "POST",
		url: "/contacts/groups/update?group_id=7",
		data: 'id='+ id +'&name='+ name +'&csrf='+ $('meta[name="csrf"]').attr('content'),
		cache: false,
		success: function(result)
		{
			var result = jQuery.parseJSON(result);

			if( result.error )
			{
				alert(result.error);
			}
			else
			{
				old_num = result.id;
			
				old_name = result.name;
	
				resetfld(result.id,result.cur,result.name,result.cont)
			}
		}
	});

	return false;
}

function GetForm(num,cur,name,cont){
out = "<form action=\"javascript:void(null);\" method=\"post\" name=\"rnfrm\" id=\"rnfrm\" onsubmit=\"submitRnFolderForm()\">\
<input type=\"hidden\" id=\"action\" name=\"action\" value=\"renfolder\">\
<input type=\"hidden\" id=\"cur_folder\" name=\"cur_folder\" value=\""+cur+"\">\
<input type=\"hidden\" id=\"cont\" name=\"cont\" value=\""+cont+"\">\
<input type=\"hidden\" id=\"id\" name=\"id\" value=\""+num+"\">\
<table width=\"218\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\
<tr>\
	<td colspan=\"2\" style=\"padding-bottom:4px;\">Новое имя:</td>\
<\/tr>\
<tr>\
	<td colspan=\"2\" style=\"padding-bottom:4px;\"><input type=\"text\" id=\"new_name\" name=\"new_name\" value=\""+htmlspecialchars(name)+"\" style=\"width: 218px;\" onblur=\"if(this.value=='') this.value='';\">\</td>\
<\/tr>\
<tr>\
	<td><input type=\"button\" name=\"resetbtn\" id=\"resetbtn\" value=\"Отменить\" onClick='resetfld(\""+num+"\",\""+cur+"\",\""+htmlspecialchars(name)+"\",\""+cont+"\");'></td>\
	<td align=\"right\"><input type=\"submit\" name=\"savebtn\" id=\"savebtn\" value=\"Сохранить\"></td>\
<\/tr>\
<\/table>\
<\/form>";

	return(out);
}