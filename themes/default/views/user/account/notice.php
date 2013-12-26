<div id="yui-main">
<div class="yui-b">

<p class="subtitle">Выберите специализации, по которым Вы хотите получать уведомления о новых проектах</p>

<?php $form = $this->beginWidget('CActiveForm'); ?>
<fieldset name="fieldset">
<? foreach ($categories[0] as $CatId => $CatName ): ?>
<div class="serviceblock">
<h4><?=$CatName?></h4>

	<? foreach ($categories[$CatId] as $ItemId => $ItemName): ?>
<div class="catline"><input id="category_<?=$ItemId?>" class="checkbox" name="services[]" value="<?=$ItemId?>" type="checkbox"<? if( in_array($ItemId, $services) ): ?> checked="checked"<? endif; ?>><label for="category_<?=$ItemId?>"><a href="#" rel="popover" title="<?=$ItemName?>" class="service" data-content=""><?=$ItemName?></a></label></div>
    <? endforeach; ?>
</div>
<? endforeach; ?>


</fieldset>

<div class="form-actions">
<button type="submit" class="btn">Сохранить</button>
</div>

<?php $this->endWidget(); ?>

</div>
</div>
<!--/yui-main-->

<script type="text/javascript">
$( document ).ready( function()
{
var timeoutObj;
$('a').popover({
    offset: 10,
    trigger: 'manual',
    html: true,
    placement: 'right',
    template: '<div class="popover" onmouseover="clearTimeout(timeoutObj);$(this).mouseleave(function() {$(this).hide();});"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
}).mouseenter(function(e) {
    $(this).popover('show');
}).mouseleave(function(e) {
    var ref = $(this);
    timeoutObj = setTimeout(function(){
        ref.popover('hide');
    }, 50);
});
	var n = $("input:checked").length;

	if( n > 9 )
	{
		$("fieldset input[type='checkbox']").attr('disabled', true);
			
		$("fieldset input[type='checkbox']:checked").attr('disabled', false);
	}

	$( "fieldset input[type='checkbox']" ).change( function()
	{
		if( $( "fieldset input[type='checkbox']:checked" ).length > 9 )
		{
			$("fieldset input[type='checkbox']").attr('disabled', true);
			
			$("fieldset input[type='checkbox']:checked").attr('disabled', false);
		}
		else
		{
			$("fieldset input[type='checkbox']").attr('disabled', false);
		}

	})
});

</script>

<?php echo $this->renderPartial('block'); ?>