<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">Контактные данные</h1>

<p class="subtitle">Контактные данные доступны только пользователям из вашего контакт листа</p>

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

<table class="profile">
<tr>
<td class="caption"><?php echo $form->labelEx($model, 'email'); ?></td>
<td>
<?php echo $form->textField($model,'email'); ?>
<?php echo $form->error($model,'email'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'icq'); ?></td>
<td>
<?php echo $form->textField($model,'icq'); ?>
<?php echo $form->error($model,'icq'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'skype'); ?></td>
<td>
<?php echo $form->textField($model,'skype'); ?>
<?php echo $form->error($model,'skype'); ?>
</td>
</tr>


<tr>
<td class="caption"><?php echo $form->labelEx($model, 'telephone'); ?></td>
<td>
<?php echo $form->textField($model,'telephone'); ?>
<?php echo $form->error($model,'telephone'); ?>
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