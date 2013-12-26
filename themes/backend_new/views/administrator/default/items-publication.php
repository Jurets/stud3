<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
	'htmlOptions' => array('class' => 'form-horizontal'),
)); 
?>
					<fieldset>

						<!-- General form elements -->
						<div class="widget row-fluid">
						    <div class="navbar">
						        <div class="navbar-inner">
						            <h6>Добавить страницу</h6>
	                                <ul class="navbar-icons">
	                                    <li><a href="#" class="tip" title="Перейти к списку страниц"><i class="icon-reorder"></i></a></li>
	                                </ul>
						        </div>
						    </div>

						    <div class="well">
						    
    <div class="control-group">
<?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
      <div class="controls">
<?php echo $form->textField($model, 'title', array('class' => 'span12')); ?>
<?php echo $form->error($model,'title', array('class'=>'help-inline', 'inputContainer' => 'div.control-group')); ?>
      </div>
    </div>

						   
    <div class="control-group">
<?php echo $form->labelEx($model, 'text', array('class' => 'control-label')); ?>
      <div class="controls">
<?php echo $form->textArea($model, 'text', array('class' => 'span12')); ?>
<?php echo $form->error($model,'text', array('class'=>'help-inline', 'inputContainer' => 'div.control-group')); ?>
      </div>
    </div>
    
    
						    </div>
						</div>
						<!-- /general form elements -->

		                <div class="form-actions">
		                    <input type="submit" value="Сохранить" class="btn btn-info pull-left" />
		                    <input type="reset" value="Очистить" class="btn btn-danger pull-right" />
		                </div>
                        
					</fieldset> 
<?php $this->endWidget(); ?>