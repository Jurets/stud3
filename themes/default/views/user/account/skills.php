<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<?php $this->widget('FlashMessages'); ?>

<?php $form = $this->beginWidget('CActiveForm'); ?>

<h1>Навыки</h1>

<p class="subtitle">Укажите через запятую ваши навыки, по которым вас смогут найти в каталоге</p>

<table class="profile">

<tr>
<td class="caption">Навыки:</td>
<td class="frnt">
<?php
$this->widget('application.extensions.tag.TagWidget', array(
	'url'=> '/user/account/json/',
	'tags' => $model->getTags(),
));
?>
</td>
</tr>

</table>

<div class="form-actions">
<button type="submit" class="btn">Сохранить</button>
</div>

<?php $this->endWidget(); ?>



</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>