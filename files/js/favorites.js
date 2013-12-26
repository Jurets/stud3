var favorites = {
	
    /**
     * Добавить в избранное, в профиле
     */
    add: function(id, el)
	{
		$.ajax({
			type: "POST",
			url: "/user/account/requests/action/add",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result.success )
				{
					if( result.success.add )
					{
						$(el).html('<i class="icon-star"></i> Удалить из избранного');
					}

					if( result.success.remove )
					{
						$(el).html('<i class="icon-star"></i> Добавить в избранное');
					}
				}
			}
		});
	
		return true
	},

    /**
     * Удалить из избранного, в аккаунте
     */
    remove: function(id, el)
	{

		$.ajax({
			type: "POST",
			url: "/user/account/requests/action/remove",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				if( result.success )
				{
					$('#user_' + id).remove();
				}
			}
		});
	
		return true
	},
}