<h1 class="title">Добавить отзыв</h1>

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

<td>
<?php echo $form->radioButtonList($model,'mark',array(Reviews::REVIEW_NEGATIVE => 'Отрицательный', Reviews::REVIEW_POSITIVE => 'Положительный'), array('separator'=>' ', 'class' => 'radio')); ?>
<?php echo $form->error($model,'mark'); ?>
</td>
</tr>

<tr>

<td class="frnt">
<?php echo $form->textArea($model,'text', array('rows' => 10)); ?>
<?php echo $form->error($model,'text'); ?>
</td>
</tr>

</table>

<div class="form-actions">
<button type="submit" class="btn">Добавить</button>
</div>

<?php $this->endWidget(); ?>