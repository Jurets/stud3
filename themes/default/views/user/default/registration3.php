<div id="container">
	<div id="content">
		<div class="page_title"><h1>Какие платные услуги для посетителей сайта вы готовы оказывать</h1></div>
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
                echo $form->hiddenField($model, 'step'); ?>
                
                <div class="row">
                    <? echo $form->checkBox($model, 'is_cources'); ?>
                    <? echo $form->labelEx($model, 'is_cources'); ?>
                </div>
                <p>Вам будут приходить предложение от людей, желающих у вас обучаться</p>
                <p>Вы можете или соглашаться или отказываться от учеников в зависимости от вашего свободного времени</p>
                <br>
                
                <div class="row">
                    <? echo $form->checkBox($model, 'is_studentsworks'); ?>
                    <? echo $form->labelEx($model, 'is_studentsworks'); ?>
                </div>
                <p>Вам будут приходить заявки на написание студенческих работ</p>
                <p>В случае вашей заинтересованности работой вы сами сможете указать цену, за которую вы готовы выполнить данную работу</p>

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