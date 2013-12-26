		<div id="container">
			<div id="content">

<h1>Пароль</h1>

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
<td class="caption"><?php echo $form->labelEx($model, 'password'); ?></td>
<td>
<?php echo $form->passwordField($model,'password'); ?>
<?php echo $form->error($model,'password'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'password2'); ?></td>
<td>
<?php echo $form->passwordField($model,'password2'); ?>
<?php echo $form->error($model,'password2'); ?>
</td>
</tr>

</table>


<button type="submit" class="btn">Сохранить</button>


<?php $this->endWidget(); ?>



			</div><!-- #content-->
		</div><!-- #container-->

		<div class="sidebar" id="sideLeft">
<?php echo $this->renderPartial('block'); ?>
			
            
		</div><!-- .sidebar#sideLeft -->