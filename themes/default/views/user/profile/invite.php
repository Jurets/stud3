<h1 class="title">Отправить приглашение</h1>

<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); 
?>

<table class="order-form">

<tr>
<td class="frnt">
<?php echo $form->textArea($model,'text', array('rows' => 10)); ?>
<?php echo $form->error($model,'text'); ?>
</td>
</tr>

</table>

<div class="form-actions">
<button type="submit" class="btn">Отправить приглашение</button>
</div>

<?php $this->endWidget(); ?>