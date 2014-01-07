var ajaxloader = true;

$(document).ready(function(){

	$("#selectsearch").change(function()
	{
		var action = $(this).val();
	  
		if( action == 'projects')
		{
			$('#action').val('projects');
		}
		if( action == 'users')
		{
			$('#action').val('users');
		}
	});

    $('ul#menu li.drop-bt').click(function() {  
        if($(this).hasClass('current'))
		{
			$(this).removeClass('current');
			
			$(this).next('ul').slideUp('slow');

			$.scrollTo('#menu', 1000);
		}
		else 
		{
			//$('ul#menu li').removeClass('current'); 
			$('ul#menu li').removeClass('current');

            $('ul#menu ul.drop-menu').slideUp('slow',function() 
			{
				
			}); 

			$(this).addClass('current');

			$(this).next('ul').slideToggle('slow');	
			
			
        }  
        return false;  
    });  

	jQuery.ajaxSetup({
		cache: false,
	  beforeSend: function() {
		  if( ajaxloader )
		  {
			$('#ajax-loader').show();
		  }
	  },
	  complete: function(){
		 $('#ajax-loader').hide();
	  },
	  success: function() {}
	});


	var hash = document.location.hash;

	// портфолио
	if (hash.indexOf('portfolio') > -1)
	{
		portfolio.open(hash.substr('portfolio'.length+1));
	}

	// кроппирование
	if (hash.indexOf('crop') > -1)
	{
		crop.open();
	}

	$("#projects").click(function() {
		$('#action').val('projects');
		$(".btn-small").removeClass("active")
		$("#projects").addClass("active");
	});
	$("#items").click(function() {
		$('#action').val('items');
		$(".btn-small").removeClass("active")
		$("#items").addClass("active");
	});
	$("#users").click(function() {
		$('#action').val('users');
		$(".btn-small").removeClass("active")
		$("#users").addClass("active");
	});

	$("#closesidebar").click(function() {
		$('.mainbd').hide();
		$(".yui-b").removeClass("yui-b")
	});
	$("#all").click(function() {
		$('.1').show();
		$('.2').show();
		$(".btn-mini").removeClass("active")
		$("#all").addClass("active");
	});
	$("#template").click(function() {
		$('.1').show();
		$('.2').hide();
		$(".btn-mini").removeClass("active")
		$("#template").addClass("active");
	});
	$("#script").click(function() {
		$('.2').show();
		$('.1').hide();
		$(".btn-mini").removeClass("active")
		$("#script").addClass("active");
	});
});


	
// esc выход
$(document).bind('keydown', function(e) { 
	if (e.which == 27) {
		CloseModal()
	}
});

	function topwidget(id)
	{
		$.ajax({
			type: "POST",
			url: "/main/top",
			data: 'specialization='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
			cache: false,
			success: function(result)
			{
				$('#topwidget').html(result);
			}
		});
	}

	function vote(id)
	{
		var vote = 0;

		var vote = $(":radio[name=poll_vote]:checked").val();
		
		if (vote)
		{
			$.ajax({
				type: "POST",
				url: "/polls/default/vote",
				data: 'id='+ vote +'&poll_id='+ id +'&csrf='+ $('meta[name="csrf"]').attr('content'),
				cache: false,
				success: function(result)
				{
					$('#poll-block').html(result);
				}
			});

		}
		else
		{
			messages('msg', 'Выберите вариант ответа')

			return false;
		}
	}
	
function OpenModal(data)
{
	ajaxloader = false;

	$(".body").css("overflow", "hidden");
	$('#fog').html(data);
	$(".fog").css("height", $(document).height());
	$(".fog").show();
	$(".body2").show();
}
function CloseModal()
{
	$(".body2").hide();
	$(".fog").hide();
	$(".body").css("overflow", "auto");
	$(".modal").hide();

	ajaxloader = true;
}
// прокрутка страницы до id scrollToElement('myId');
function scrollToElement(theElement) {
    if (typeof theElement === "string") theElement = document.getElementById(theElement);
 
    var selectedPosX = 0;
    var selectedPosY = 0;
 
    while (theElement != null) {
        selectedPosX += theElement.offsetLeft;
        selectedPosY += theElement.offsetTop;
        theElement = theElement.offsetParent;
    }
 
    window.scrollTo(selectedPosX, selectedPosY);
}

function getList(src, type)
{
	id = src.options[src.selectedIndex].value;

	$.post('/user/default/geolocation', {id: id, csrf: $('meta[name="csrf"]').attr('content')}, onAjaxSuccess);

	function onAjaxSuccess(data) {

		out = document.getElementById(type);

		for (var i = out.length - 1; i >= 0; i--) {

			out.options[i] = null;

		}

		eval(data);
		
		$("#TendersSearch_city").trigger("liszt:updated");
	}


	return true;
}

/**
 * Сообщения об ошибках
 */
function messages(a, string)
{
	switch (a)
	{
		case 'noaccess':
			$.sticky('Авторизуйтесь, чтобы получить возможность пользоваться дополнительными услугами.');
		break
		case 'error':
			$.sticky(string);
		break
		case 'msg':
			$.sticky(string);
		break
		default:
		alert('error')
	}
}

// свернуть / развернуть переписку
function letters(id, el)
{
	bids = $('.bids_' + id);
	$(el).hide()
	bids.show();
}

// отправка сообщения
function send(id, el)
{
	bids = $('#bids_' + id)
	list = $('.list_' + id)
	if( list.text() ) {
		list.hide();
		bids.show();
	}
	form = $('#bid_' + id)
	inputtext = form.find(':input[name$="text"]');
	text = inputtext.val();
    if( text.length > 256 ) {
        alert('Текст сообщения не должен содержать больше 1000 символов');
		return false;
	}
    if( text.length == 0 ) {
        alert('Текст сообщения не должен быть пустым');
		return false;
	}
	$.ajax({
		type: "POST",
		url: "/tenders/default/addletter",
		data: 'id='+ id +'&text='+ text +'&csrf='+ $('meta[name="csrf"]').attr('content'),
		cache: false,
		success: function(result) {
			var result = jQuery.parseJSON(result);	
            if (result.success) {
                ans = result.html;
			    bids.append(ans);
			    inputtext.val('');
            }
		}
	});
}



function toggle_pool() {
    if ($$('.poll-line')[0].style.display != 'none') {
		$$('.poll-line').setStyle('display', 'none');
		$$('.poll-st').setStyle('display', 'none');
		$$('.poll-type').setStyle('display', 'none');
	} else {
		$$('.poll-line').setStyle('display', '');
		$$('.poll-st').setStyle('display', '');
		$$('.poll-type').setStyle('display', '');
	}
}
