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


            </ul>
          </div>
        </div>
      </div>
    </div>

<div class="form-actions">
<button type="submit" class="btn btn-info">Войти</button>
</div>

<?php $this->endWidget(); ?>

</div>