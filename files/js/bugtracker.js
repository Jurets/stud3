var bugtracker = {

	page: 5,

    send: function(id, action)
	{
		$.ajax({
			type: "POST",
			url: "/items/bugtracker/control",
			dataType: 'json',
			data: 'id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content') +'&action=' + action,
			cache: false,
			success: function(result)
			{
				if( result.error )
				{

				}

				if( result.success )
				{
					$('#bug_' + id).replaceWith(result.success.data);
				}
			}
		});
	},

    get: function(id)
	{
		$.ajax({
			type: "POST",
			url: "/items/bugtracker/get",
			dataType: 'json',
			data: 'csrf='+ $('meta[name="csrf"]').attr('content') +'&page=' + bugtracker.page +'&id=' + id,
			cache: false,
			success: function(result)
			{
				if( result )
				{
					if( result.error )
					{
						messages('error', result.error.msg);
					}

					if( result.success )
					{
						$("#bugtracker").append(result.success.data);
		
						bugtracker.page = bugtracker.page + 5;
					}
				}
			}
		});
	}
}