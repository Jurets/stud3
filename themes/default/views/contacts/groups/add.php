<div id="yui-main">
<div class="yui-b">

<h1>Мои контакты</h1>

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
<?php echo $form->textField($model,'name'); ?>
<?php echo $form->error($model,'name'); ?>
</div>
<div>
<div class="form-actions">
<button type="submit" class="btn btn-info">Добавить</button>
</div>
</div>

<?php $this->endWidget(); ?>



  </div>

</div>
<!--/yui-main-->

<?php echo $this->renderPartial('//user/account/block'); ?>