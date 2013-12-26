<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Личные данные</h1>

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
<td class="caption"><?php echo $form->labelEx($model, 'surname'); ?></td>
<td>
<?php echo $form->textField($model, 'surname'); ?>
<?php echo $form->error($model, 'surname'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'name'); ?></td>
<td>
<?php echo $form->textField($model, 'name'); ?>
<?php echo $form->error($model, 'name'); ?>
</td>
</tr>
<tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'dob'); ?></td>
<td>
<?
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	'model'=>$model,
	'attribute'=>'dob',
	'language'=>'ru',

    // additional javascript options for the date picker plugin
	'options' => array (
		'yearRange' => '-80:-16',
		'changeYear'=>true,
		'changeMonth'=>true,
		'showAnim'=>'fold',
		
		//set calendar z-index higher then UI Dialog z-index 
		'beforeShow'=>"js:function() {
			$('.ui-datepicker').css('font-size', '0.8em');
			$('.ui-datepicker').css('z-index', parseInt($(this).parents('.ui-dialog').css('z-index'))+1);
		}",
	),
    'htmlOptions'=>array('size' => 10, 'maxlength' => 15,  'readonly' => 'readonly'),
));
?>
<?php echo $form->error($model, 'dob'); ?>
</td>
</tr>
<tr>

<tr>
<td><?php echo $form->labelEx($model, 'gender'); ?></td>
<td>
<?php echo $form->radioButtonList($model, 'gender',array('1'=>'Мужской','2'=>'Женский'), array('separator'=>' ', 'class' => 'radio')); ?>
<?php echo $form->error($model, 'gender'); ?>
</td>
</tr>


</table>


<br />

<p class="subtitle">Дополнительная информация в профиле</p>
<table class="profile">

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'short_descr'); ?></td>
<td>
<?php echo $form->textField($model, 'short_descr'); ?>
<?php echo $form->error($model, 'short_descr'); ?>
</td>
</tr>

<tr>
<td><?php echo $form->labelEx($model, 'specialization'); ?></td>
<td>
<?php echo $form->dropDownList($model, 'specialization', $model->getSpecializationList(), array('empty' => 'Выберите деятельность')); ?>
<?php echo $form->error($model, 'specialization'); ?>
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