var blog = {

    /**
     * Добавить в избранное
     */
    tofavorite: function(id, el)
	{
		active = $(el).hasClass("active");
	
		$.ajax({
			type: "POST",
			url: "/blogs/default/favorite",
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
			url: "/blogs/default/like",
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