<div id="yui-main">
<div class="yui-b">

<h1>Добавить кошелек</h1>

<div>

<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation' => true,
	'errorMessageCssClass' => 'alert alert-error',
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => true,
	),
)); 
?>

<div>
<?php echo $form->textField($model,'purse'); ?>&nbsp &nbsp Пример: R123456789012
<?php echo $form->error($model,'purse'); ?>
</div>
<div>
<div class="form-actions">
<button type="submit" class="btn btn-info">Добавить</button>
</div>
</div>

<?php $this->endWidget(); ?>
</div>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>