	<!-- Content -->
    <div class="content" id="container">
    	<div class="title"><h5>Пользователи</h5></div>

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
                    <div class="head"><h5 class="iList">Забанить пользователя</h5></div>

<div class="rowElem noborder"><?php echo $form->labelEx($banned, 'descr'); ?>

<div class="formRight">
<?php echo $form->textField($banned,'descr'); ?>
<?php echo $form->error($banned,'descr'); ?>
</div>
<div class="fix"></div>
</div>


                        <input type="submit" value="Забанить" class="greyishBtn submitForm" />
                        <div class="fix"></div>

                </div>
            </fieldset>

<?php $this->endWidget(); ?>
                
    </div>