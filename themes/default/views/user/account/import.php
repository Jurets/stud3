<script type="text/javascript">
function send()
{
	var data = { 'projects[]' : []};
	$(":checked").each(function() {
	  data['projects[]'].push($(this).val());
	});

	$.ajax({
		type: "POST",
		url: "/user/account/importprojects",
		data: data,
		success: function(html)//Получаем текст со страницы
		{
			document.location.href = '/user/account/import';
		}
	});

	return false;
}
</script>
<div id="yui-main">
<div class="yui-b">
<div class="infoblock">
<strong>Импортирование проектов</strong><br /><br />

<? if( $articles ): ?>

<? foreach($articles as $row => $value): ?>
<label class="checkbox inline">
  <input type="checkbox" name="projects[]" value="<?=$row?>"<? if( $value['check'] ): ?> disabled="disabled"<? endif; ?>> <?=$value['title']?> <? if( $value['check'] ): ?> &#10004; <? endif; ?>
</label>
<br />
<? endforeach; ?>

<? else: ?>
Ничего не найдено
<? endif; ?>

<div class="form-actions">
<button onclick="send()" type="submit" class="btn">Импортировать</button>
</div>

</div>
</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>