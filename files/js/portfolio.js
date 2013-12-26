var portfolio = {

    /**
     * Закрыть
     */
    close: function(id, el)
	{
		CloseModal();
	},

    /**
     * Открыть
     */
    open: function(id, el)
	{
		$.ajax({
			type: "POST",
			url: "/portfolio/default/show",
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(data)
			{
				OpenModal(data);
			}
		});
	},

    /**
     * Отправить комментарий
     */
    send: function(id, el)
	{
		bids = $('#bids_' + id)
	
		form = $('#bid_' + id)
	
		inputtext = form.find(':input[name$="text"]');
	
		text = inputtext.val();
	
		$.ajax({
			type: "POST",
			url: "/portfolio/comment/add",
			dataType: 'json',
			data: 'id='+ id +'&text='+ text +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result )
				{
					if( result.success )
					{
	
			            ans = '     <li>\
										<div class="text">\
											<div class="line">\
												<a href="#" title="' + result.username + '">' + result.username + '</a>\
												<span class="date">' + result.date + '</span>\
											</div><!-- end_line -->\
											<p>' + result.text + '</p>\
										</div><!-- end_text -->\
									</li>';
			
						bids.prepend(ans);
						
						inputtext.val('');
					}
	
				}
			}
		});
	},

    /**
     * Нравится
     */
    like: function(id, el)
	{
		active = $(el).hasClass("active");
	
		if( active )
		{
			return false;
		}
	
		count = parseInt($(el).html());
	
		count++;
	
		$.ajax({
			type: "POST",
			url: "/portfolio/default/like",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result )
				{
					if( result.success )
					{
						$(el).addClass("active");
			
						$(el).html(count)
					}
	
					if( result.error )
					{
						if( result.error.noaccess )
						{
							messages('noaccess');
						}
					}
	
				}
			}
		});
	
		return false;
	},

    /**
     * Главное изображение
     */
    main: function(id, el)
	{
		var ajaxData = {};

		ajaxData['id'] = id;
		ajaxData['csrf'] = $('meta[name="csrf"]').attr('content');

		checked = $(el).attr('checked');

		$(el).prop('checked', false);

		if( checked )
		{
			ajaxData['checked'] = true;
		}

		$.ajax({
			type: "POST",
			url: "/portfolio/default/main",
			dataType: 'json',
			data: ajaxData,
			cache: false,
			success: function(result)
			{	
				if( result )
				{
					if( result.success )
					{
						if( checked )
						{
							$(el).prop('checked', true);
						}
						else
						{
							$(el).prop('checked', false);
						}
					}
	
					if( result.error )
					{
						messages('error', result.error);
					}
	
				}
			}
		});
	
		return false;
	},
}