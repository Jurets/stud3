<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Резюме</h1>

<p class="subtitle">Подробное описание</p>

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

<?php $this->widget('EMarkitupWidget',array('attribute' => 'full_descr', 'model' => $model));?>

<?php echo $form->error($model,'full_descr'); ?>

<div class="form-actions">
<button type="submit" class="btn">Сохранить</button>
</div>

<?php $this->endWidget(); ?>



</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>