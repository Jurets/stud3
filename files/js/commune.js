var commune = {

    /**
     * Добавить в избранное
     */
    tofavorite: function(id, el)
	{
		active = $(el).hasClass("active");
	
		$.ajax({
			type: "POST",
			url: "/commune/blog/favorite",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result )
				{
					if( result.success )
					{
						if( active )
						{
							$(el).removeClass("active");
						}
						else
						{
							$(el).addClass("active");
						}
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

    vote: function(id, type)
	{
		$.ajax({
			type: "POST",
			url: "/commune/default/vote",
			dataType: 'json',
			data: 'id='+ id +'&type='+ type +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)//Получаем текст со страницы
			{

				if( result )
				{
					if( result.success )
					{
						$('#rating_' + id).fadeOut(300);
						$('#rating_' + id).html(result.success);
						$('#rating_' + id).fadeIn(300);
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
			url: "/commune/blog/like",
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
}