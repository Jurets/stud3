<div id="yui-main">
<div class="yui-b">

<h1>Добавить заявку на вывод</h1>



<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); 
?>
<?php echo $form->error($model, 'purse'); ?>
<?php echo $form->error($model, 'amount'); ?>
<div id="msearch">

<? if( $purses ): ?>
<div>
<?php echo $form->dropDownList($model, 'purse', CHtml::listData($purses, 'purse', 'purse'), array('empty' => 'Выберите кошелек')); ?>
</div>
<? else: ?>
<div>
Перед выводом необходимо <a href="/account/addpurse">указать</a> кошелек.
</div>
<? endif; ?>

<div>
<?php echo $form->labelEx($model, 'amount'); ?> <?php echo $form->textField($model, 'amount'); ?>
</div>


<div class="form-actions">
<button type="submit" class="btn btn-info">Добавить</button>
</div>


<?php $this->endWidget(); ?>
</div>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>