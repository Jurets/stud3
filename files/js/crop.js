function init() 
{
	// Create variables (in this scope) to hold the API and image size
	var jcrop_api, boundx, boundy;
      
	$('#target').Jcrop({

		onChange: actionCrop,
		onSelect: actionCrop,
		aspectRatio: 1,

		minSize: [100, 100]
		
	},function(){
	// Use the API to get the real image size
		var bounds = this.getBounds();
		boundx = bounds[0];
		boundy = bounds[1];
		// Store the API in the jcrop_api variable
		jcrop_api = this;
		jcrop_api.animateTo([0,0,100,100]);
		api.setOptions({ bgFade: true});
	});

	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Please select a crop region then press submit.');
		return false;
	};

	function updateCoords(c)
	{
		$('#crop_x').val(c.x);
		$('#crop_y').val(c.y);
		$('#crop_w').val(c.w);
		$('#crop_h').val(c.h);
	};

	function updatePreview(c)
	{
		if (parseInt(c.w) > 0)
		{
			var rx = 100 / c.w;
			var ry = 100 / c.h;

			$('#preview').css({
				width: Math.round(rx * boundx) + 'px',
				height: Math.round(ry * boundy) + 'px',
				marginLeft: '-' + Math.round(rx * c.x) + 'px',
				marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
	};

	function actionCrop(c)
	{
		updateCoords(c);
		updatePreview(c);
	};
};

var crop = {

    ajax: function(id)
	{
		// ajax request to send
		var ajaxData = {};

		ajaxData[id+'_x'] = $('#'+ id +'_x').val();
		ajaxData[id+'_x2'] = $('#'+ id +'_x2').val();
		ajaxData[id+'_y'] = $('#'+ id +'_y').val();
		ajaxData[id+'_y2'] = $('#'+ id +'_y2').val();
		ajaxData[id+'_h'] = $('#'+ id +'_h').val();
		ajaxData[id+'_w'] = $('#'+ id +'_w').val();
		
		ajaxData['csrf'] = $('meta[name="csrf"]').attr('content');

		$.ajax({
			type: "post",
			url: '/user/account/crop',
			data: ajaxData,
			dataType: 'json',
			success: function(result)
			{
				if( result.success )
				{	
					document.location.href = '/account/userpic';
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
     * Открыть
     */
    open: function()
	{
		ajaxloader = false;

		$.ajax({
			type: "POST",
			url: "/user/account/LoadCrop",
			data: 'csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(data)
			{
				OpenModal(data);
				init();
			}
		});
	},
}