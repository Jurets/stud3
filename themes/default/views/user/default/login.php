<div id="authform" class="yui-g">
  <h1>Вход в систему</h1>

<?php $this->widget('FlashMessages'); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
)); 
?>
    <div class="rnd">
      <div>
        <div>
          <div>

            <ul>
<li>
<?php echo $form->labelEx($model, 'username'); ?>
<?php echo $form->textField($model, 'username') ?>
<?php echo $form->error($model, 'username'); ?>
</li>

<li>
<?php echo $form->labelEx($model, 'password'); ?>
<?php echo $form->passwordField($model, 'password',array('maxlength' => Yii::app()->getModule('user')->maxPasswordLength)) ?>
<?php echo $form->error($model, 'password'); ?>
</li>

            </ul>
          </div>
        </div>
      </div>
    </div>

<div class="form-actions">
<button type="submit" class="btn">Войти</button>
</div>

<?php $this->endWidget(); ?>

</div>