<?php
/**
 * Created by PhpStorm.
 * User: m.popov
 * Date: 10.12.13
 * Time: 22:15
 */
?>
<div class="row-fluid">
    <div class="span12">
        <section class="title-section">
            <h1 class="title-header">Оценка работы</h1>
            <!-- BEGIN BREADCRUMBS-->
            <ul class="breadcrumb breadcrumb__t">
                <li><a href="/">Главная</a></li>
                <li class="divider"> / </li>
                <li class="active">Оценка работы</li>
            </ul>
        </section>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <section class="">
            <h1 class="title-header" style="margin-bottom: 0; margin-top:40px;">Дополнительные параметры</h1>
        </section>
        <p>Текст</p>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'enableClientValidation' => true,
            'enableAjaxValidation'   => true,
            'errorMessageCssClass'   => 'none',
            'clientOptions'          => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType'   => false,
                'afterValidate'    => 'js:function(form, data, hasError){
			string = "";
			$.each(data, function(index, value)
			{
				if(index != "__proto")
				{
					var temp = data[index][0];
					string += "<li>"+temp+"</li>";
				}
			});
			if(hasError) messages(\'error\', string);
			if(!hasError) return true;
		}'
            ),
        ));
        ?>
        <?php /* @var $form CActiveForm */ ?>
        <?php echo $form->error($model, 'category'); ?>
        <?php echo $form->error($model, 'title'); ?>
        <?php echo $form->error($model, 'text'); ?>
        <?php echo $form->error($model, 'budget'); ?>

        <div class="row-fluid">
            <div class="span12">
                <p class="pull-right">!!!!!!!!!!!!!!!!!!!!!!</p>
                <?php echo $form->label($model, 'spec'); ?>
                <?php echo $form->dropDownList($model, 'spec', array()); ?>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->label($model, 'pages'); ?>
                <?php echo $form->textField($model, 'pages', array('class' => 'inp_text', 'placeholder' => '')); ?>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->label($model, 'font'); ?>
                <?php echo $form->dropDownList($model, 'font', array(12 => 12, 14 => 14)); ?>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->label($model, 'day'); ?>
                <?php echo $form->textField($model, 'day', array('class' => 'inp_text datepicker', 'placeholder' => '')); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->label($model, 'file'); ?>
                <?php echo $form->fileField($model, 'file', array('class' => 'inp_text', 'placeholder' => '', 'multiple' => 'multiple')); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php echo $form->label($model, 'persent'); ?>
                <?php echo $form->textField($model, 'persent', array('class' => 'inp_text', 'placeholder' => '')); ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span4">
                <?php echo $form->labelEx($rmodel, 'captcha'); ?>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($rmodel, 'captcha', array('size' => 5, 'class' => 'row-fluid')); /*выводим текстовое поле для ввода каптчи*/ ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6"></div>
            <div class="span6">
                <?php echo CHtml::submitButton('Отправить', array('class' => 'green-submit pull-right')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="span6">

</div>
</div>