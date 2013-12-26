function addCheckbox(id, name) {
   var container = $('#cblist');
   var inputs = container.find('input');
   var html = '<li><label><input name="attachments[]" type="checkbox" value="'+id+'" checked="checked" /> '+name+'</label></li>';
   container.append($(html));
}
function addUploadFile(fileName)
{
	addCheckbox(fileName.attachment_id, fileName.filename);
}

$(document).ready(function(){

	$("#list").click(function() {
		$.cookie('cookie_name', null);
	
		$.cookie('cookie_name', 'list');
	
		$(".item-grid").removeClass("item-grid").addClass("item-list");
	});

	$("#grid").click(function() {
		$.cookie('cookie_name', null);
	
		$.cookie('cookie_name', 'grid');
	
		$(".item-list").removeClass("item-list").addClass("item-grid");
	});

});

var items = {

    buy: function(id)
	{
		$.ajax({
			type: "POST",
			url: '/user/account/NewPayment?id=' + id + '&action=apply',
			dataType: 'json',
			data: 'csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result.error )
				{
					error = '<div class="alert alert-error" id="n">\
					<a class="close" data-dismiss="alert">&times;</a>\
					' + result.error.msg + '\
					</div>';

					bids = $('#error')
					bids.html(error);
				}

				if( result.success )
				{
					document.location.href = '/account/payments/' + result.id + '.html';
				}
			}
		});
	},

    /**
     * Закрыть
     */
    close: function()
	{
		CloseModal();
	},

    /**
     * Открыть окно предупреждения
     */
    request: function(id)
	{
		$.ajax({
			type: "POST",
			url: "/items/default/request?id=" + id,
			data: 'csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(data)
			{
				OpenModal(data);
			}
		});
	},

    /**
     * Открыть окно предупреждения
     */
    send: function(id)
	{
		var text = $('#report').val();
	
		var dataString = 'text='+ text + '&csrf='+ $('meta[name="csrf"]').attr('content');
	
		if( text.length > 256 )
		{
			alert('Текст сообщения не должно содержать больше 256 символов');
	
			return false;
		}
	
		if( text.length == 0 )
		{
			alert('Текст сообщения не должно быть пустым');
	
			return false;
		}

		$.ajax({
			type: "POST",
			url: "/items/default/request?id=" + id + "&action=apply",
			dataType: 'json',
			data: dataString,
			cache: false,
			success: function(result)
			{
				if( result.error )
				{
					alert('Ошибка! Предупреждение не отправлено!');
				}

				if( result.success )
				{
					alert('Предупреждение отправлено');
				}

				CloseModal();
			}
		});
	},

    buy: function(id)
	{
		$.ajax({
			type: "POST",
			url: "/user/account/buy",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result.error )
				{
					if( result.error.msg )
					{
						messages('msg', result.error.msg)
					}
				}

				if( result.success )
				{// переадресация
					document.location.href = result.url;
				}
			}
		});
	
		return true
	},

    /**
     * Отправить купленный файл на email
     */
    email: function(id)
	{
		$.ajax({
			type: "POST",
			url: "/user/account/SendToEmail",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result.success )
				{
					alert('Файл отправлен');
				}
			}
		});
	
		return true
	},
}