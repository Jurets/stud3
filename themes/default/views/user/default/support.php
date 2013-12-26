<div class="yui-g">
<h1>Обратная связь</h1>

<div class="subtitle"></div>

<?php $this->widget('FlashMessages'); ?>

<div class="content">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'support-form',
	'enableClientValidation' => true,
	'errorMessageCssClass' => 'alert alert-error',
)); 
?>
<div class="contactus rnd">
<ul>
<li>
<?php echo $form->labelEx($model, 'email'); ?>
<?php echo $form->textField($model, 'email') ?>
<?php echo $form->error($model, 'email'); ?>
</li>
<li>
<?php echo $form->labelEx($model, 'text'); ?>
<?php echo $form->textArea($model, 'text', array('cols' => 48, 'rows' => 6)) ?>
<?php echo $form->error($model, 'text'); ?>
</li>
<li>
<?php echo $form->labelEx($model, 'verifyCode'); ?></td>
<?php $this->widget('CCaptcha', array('buttonLabel' => '</br>Получить новый код', 'showRefreshButton' => true)); ?><br />
<?php echo $form->textField($model, 'verifyCode', array('style' => "width:95px;")); ?>
<?php echo $form->error($model, 'verifyCode'); ?>
</li>
</ul>
</div>
<div class="form-actions">
<button type="submit" class="btn btn-info">Отправить сообщение</button>
</div>
<?php $this->endWidget(); ?>
</div>
</div>