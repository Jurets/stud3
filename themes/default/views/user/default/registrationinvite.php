<div id="authform" class="yui-g">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => true,
		'validateOnType' => false,
	),
)); 
?>

<table class="order-form">
<tr>
<td valign="top" class="caption"><?php echo $form->labelEx($model, 'invitecode'); ?></td>
<td>
<?php echo $form->textField($model,'invitecode'); ?>
<?php echo $form->error($model,'invitecode'); ?>
</td>
</tr>

<tr>
<td valign="top" class="caption"><?php echo $form->labelEx($model, 'username'); ?></td>
<td>
<?php echo $form->textField($model,'username'); ?> &nbsp; &nbsp; <span class="label label-info"><i class="icon-info-sign icon-white"></i> Минимальное количество символов 3. Максимальное количество символов 15.</span>
<?php echo $form->error($model,'username'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'email'); ?></td>
<td>
<?php echo $form->textField($model,'email'); ?> &nbsp; &nbsp; <span class="label label-info"><i class="icon-info-sign icon-white"></i> Третьи лица не имеют доступ к этой информации.</span>
<?php echo $form->error($model,'email'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'surname'); ?></td>
<td>
<?php echo $form->textField($model,'surname'); ?> &nbsp; &nbsp; <span class="label label-info"><i class="icon-info-sign icon-white"></i> Возможно использовать только кириллицу и латиницу.</span>
<?php echo $form->error($model,'surname'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'name'); ?></td>
<td>
<?php echo $form->textField($model,'name'); ?> &nbsp; &nbsp; <span class="label label-info"><i class="icon-info-sign icon-white"></i> Возможно использовать только кириллицу и латиницу.</span>
<?php echo $form->error($model,'name'); ?>
</td>
</tr>
<tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'gender'); ?></td>
<td>
<?php echo $form->radioButtonList($model,'gender',array('1'=>'Мужской','2'=>'Женский'), array('separator'=>' ')); ?>
<?php echo $form->error($model,'gender'); ?>
</td>
</tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'password'); ?></td>
<td>
<?php echo $form->passwordField($model,'password'); ?> &nbsp; &nbsp; <span class="label label-info"><i class="icon-info-sign icon-white"></i> Минимальное количество символов 6. Максимальное количество символов 20.</span>
<?php echo $form->error($model,'password'); ?>
</td>
</tr>
<tr>

<tr>
<td class="caption"><?php echo $form->labelEx($model, 'password2'); ?></td>
<td>
<?php echo $form->passwordField($model,'password2'); ?> &nbsp; &nbsp; <span class="label label-info"><i class="icon-info-sign icon-white"></i> Минимальное количество символов 6. Максимальное количество символов 20.</span>
<?php echo $form->error($model,'password2'); ?>
</td>
</tr>
<tr>

<?php if( Yii::app()->getModule('user')->showCaptcha ): ?>
<?php if( extension_loaded('gd') ): ?>
<tr>
<td class="caption"><?php echo $form->labelEx($model, 'verifyCode'); ?></td>
<td><?php $this->widget('CCaptcha', array('buttonLabel' => '</br>Получить новый код', 'showRefreshButton' => true)); ?><br />
<?php echo $form->textField($model, 'verifyCode'); ?>
<?php echo $form->error($model, 'verifyCode'); ?>
</td>
</tr>
<?php endif; ?>
<?php endif; ?>     
    
<tr>
<td colspan="2">
<?php echo $form->checkBox($model,'agree',array('value'=>TRUE, 'uncheckValue' => FALSE)); ?>&nbsp; &nbsp; 
<?php echo $form->label($model,'agree'); ?>
<?php echo $form->error($model,'agree'); ?>
</td>
</tr>

<tr>

</table>

<br />

<div class="form-actions">
<button type="submit" class="btn">Регистрация</button>
</div>

<?php // echo CHtml::submitButton('Регистрация'); ?>

<?php $this->endWidget(); ?>
</div>