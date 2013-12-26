<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Оповещения</h1>

<?php $this->widget('FlashMessages'); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); 
?>

<table class="setting">
<tr>
<td class="caption"><?php echo $form->labelEx($model, 'mailer'); ?></td>
<td>
<?php echo $form->checkBox($model, 'mailer'); ?>
</td>
</tr>

</table>

<p class="subtitle">Уведомления о событиях</p>
<table class="setting">
<tr>
<td class="caption"><?php echo $form->labelEx($model, 'invite'); ?></td>
<td>
<?php echo $form->checkBox($model, 'invite'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'blogs'); ?></td>
<td>
<?php echo $form->checkBox($model, 'blogs'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'projects'); ?></td>
<td>
<?php echo $form->checkBox($model, 'projects'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'items'); ?></td>
<td>
<?php echo $form->checkBox($model, 'items'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'messages'); ?></td>
<td>
<?php echo $form->checkBox($model, 'messages'); ?>
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