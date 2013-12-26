var notification_delay = '10000';

setInterval(function() {
	Notification();
}, notification_delay);

setInterval(function() {
	Events();
}, notification_delay);
Notification();
Events();
/**
 * Получение количества новых личных сообщений, также добавить события
 */
function Notification() 
{
	ajaxloader = false;
	$.ajax({
		type: "POST",
		url: "/main/messages",
		dataType: 'json',
		data: 'csrf='+ $('meta[name="csrf"]').attr('content'),
		cache: false,
		success: function(resp)
		{
            if ( resp && resp.success ) {
                    if ( resp.msg > 0 ) {

                        $('#userbar_message').html('Новые сообщения (' + resp.msg + ')');

                    } else {
                        $('#userbar_message').html('Контакты');
                    }

            }
		}
	});

ajaxloader = true;
    return true;
}

function closeEvent(id)
{
	$.ajax({
		type: "POST",
		url: "/main/events",
		data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
		cache: false,
		success: function(resp)
		{
			return true;
		}
	});
}
function closeNotification(id)
{
	$.ajax({
		type: "POST",
		url: "/main/messages",
		data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
		cache: false,
		success: function(resp)
		{
			return true;
		}
	});
}
/**
 * Получение событий
 */
function Events() {
	ajaxloader = false;
	$.getJSON('/main/events', function(data)
	{
		if( data.error )
		{
			return false;
		}

		$.each(data.events, function(key, val) {		

			href = '';

			if( val.location )
			{
				if( val.link )
				{
					href = '<a href="http://fnetwork.ru/' + val.location + '">' + val.link + '</a>';
				}
				else
				{
					href = '<a href="http://fnetwork.ru/' + val.location + '">Перейти к событию</a>';
				}
			}

			message = '<img src="/data/userpics/' + val.userpic + '" style="height:48px;float:left;" /><p id="tweet" style="margin:0;padding:0;margin-left:60px;font-size:13px;font-style:italic;"><strong>Новое уведомление</strong><br />' + val.title + '<br />' + href + '</p>';
			
			$.sticky(message);
							
			closeEvent(val.id);
		});

	});
	ajaxloader = true;
    return true;
}