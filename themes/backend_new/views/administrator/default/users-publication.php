	<!-- Content -->
    <div class="content" id="container">
    	<div class="title"><h5>Пользователи</h5></div>

<? if( $model->isNewRecord ): ?>
            <div class="nNote nInformation hideit">
                <p>После добавления пользователя, на указанный email придут данные для входа.</p>
            </div>   
<? endif; ?>

        <!-- Form begins -->
<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
	'htmlOptions' => array('class' => 'mainForm'),
)); 
?>
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList"><?=($model->isNewRecord) ? 'Добавить пользователя' : 'Редактировать пользователя'?></h5></div>

<div class="rowElem noborder"><?php echo $form->labelEx($model, 'username'); ?>

<div class="formRight">
<?php echo $form->textField($model,'username'); ?>
<?php echo $form->error($model,'username'); ?>
</div>
<div class="fix"></div>
</div>

<div class="rowElem noborder"><?php echo $form->labelEx($model, 'balance'); ?>

<div class="formRight">
<?php echo $form->textField($model,'balance'); ?>
<?php echo $form->error($model,'balance'); ?>
</div>
<div class="fix"></div>
</div>

<div class="rowElem noborder"><?php echo $form->labelEx($model, 'email'); ?>

<div class="formRight">
<?php echo $form->textField($model,'email'); ?>
<?php echo $form->error($model,'email'); ?>
</div>
<div class="fix"></div>
</div>

<? if( $model->isNewRecord ): ?>
<div class="rowElem noborder"><?php echo $form->labelEx($model, 'password'); ?>

<div class="formRight">
<?php echo $form->textField($model,'password'); ?>
<?php echo $form->error($model,'password'); ?>
</div>
<div class="fix"></div>
</div>
<? endif; ?>

<div class="rowElem"><?php echo $form->labelEx($model, 'name'); ?>

<div class="formRight">
<?php echo $form->textField($model,'name'); ?>
<?php echo $form->error($model,'name'); ?>
</div>
<div class="fix"></div>
</div>

<div class="rowElem"><?php echo $form->labelEx($model, 'surname'); ?>

<div class="formRight">
<?php echo $form->textField($model,'surname'); ?>
<?php echo $form->error($model,'surname'); ?>
</div>
<div class="fix"></div>
</div>

<div class="rowElem"><?php echo $form->labelEx($model, 'short_descr'); ?>

<div class="formRight">
<?php echo $form->textField($model, 'short_descr'); ?>
<?php echo $form->error($model, 'short_descr'); ?>
</div>
<div class="fix"></div>
</div>

<div class="rowElem"><?php echo $form->labelEx($model, 'full_descr'); ?>

<div class="formRight">
<?php echo $form->textArea($model, 'full_descr', array('rows' => 8)); ?>
<?php echo $form->error($model, 'full_descr'); ?>
</div>
<div class="fix"></div>
</div>


                        <input type="submit" value="<?=($model->isNewRecord) ? 'Добавить' : 'Сохранить'?>" class="greyishBtn submitForm" />
                        <div class="fix"></div>

                </div>
            </fieldset>

<?php $this->endWidget(); ?>
                
    </div>