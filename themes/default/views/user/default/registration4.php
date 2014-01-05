<div id="container">
	<div id="content">
		<div class="page_title"><h1>Заполните дополнительную информацию о ваших курсах</h1></div>
		<div class="cabinet">
            <?php $form = $this->beginWidget('CActiveForm', array(
	            'id'=>'registration-form',
	            'enableClientValidation' => false,
	            'enableAjaxValidation' => false,
	            'focus'=>array($model,'username'),
	            'errorMessageCssClass'=>'alert alert-error',
	            'clientOptions' => array(
		            'validateOnSubmit' => true,
		            'validateOnChange' => true,
		            'validateOnType' => false,
	            ),
            ));  
                //echo $form->hiddenField($model, 'step'); ?>
                
                <div class="row">
                    <? echo $form->checkBox($model, 'is_home'); ?>
                    <? echo $form->labelEx($model, 'is_home'); ?>
                </div>
                <div class="row">
                    <? echo $form->labelEx($model, 'home_mapplace'); ?>
                    <? echo $form->textField($model, 'home_mapplace'); ?>
                </div>
                <div class="row">
                    <? echo $form->labelEx($model, 'home_pricehour'); ?>
                    <? echo $form->textField($model, 'home_pricehour'); ?>
                </div>
                
                <div class="row">
                    <? echo $form->checkBox($model, 'is_studenthome'); ?>
                    <? echo $form->labelEx($model, 'is_studenthome'); ?>
                </div>

                <div class="row">
                    <? echo $form->labelEx($model, 'studenthome_pricehour'); ?>
                    <? echo $form->textField($model, 'studenthome_pricehour'); ?>
                </div>
                
                <div class="row">
                    <? echo $form->checkBox($model, 'is_weblearning'); ?>
                    <? echo $form->labelEx($model, 'is_weblearning'); ?>
                </div>
                
                <div class="row">
                    <? echo $form->labelEx($model, 'weblearning_pricehour'); ?>
                    <? echo $form->textField($model, 'weblearning_pricehour'); ?>
                </div>
                
                <p>Выберите для кого ваши курсы</p>
                <div class="row">
                    <? echo $form->checkBox($model, 'cources_forchild'); ?>
                    <? echo $form->labelEx($model, 'cources_forchild'); ?>
                </div>
                <div class="row">
                    <? echo $form->checkBox($model, 'cources_forschoolchild'); ?>
                    <? echo $form->labelEx($model, 'cources_forschoolchild'); ?>
                </div>
                <div class="row">
                    <? echo $form->checkBox($model, 'cources_forstudents'); ?>
                    <? echo $form->labelEx($model, 'cources_forstudents'); ?>
                </div>
                <div class="row">
                    <? echo $form->checkBox($model, 'cources_foradults'); ?>
                    <? echo $form->labelEx($model, 'cources_foradults'); ?>
                </div>

	            <table>
		            <tr>
			            <td><input type="submit" class="inp_sub" value="ПРОДОЛЖИТЬ" /></td>
		            </tr>
                </table>
                
            <?php $this->endWidget(); ?>
        </div>
    </div><!-- #content-->
</div><!-- #container-->

<div class="sidebar" id="sideLeft">
    <? $this->widget('MenuWidget') ?>
</div><!-- .sidebar#sideLeft -->