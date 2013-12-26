		<div id="container">
			<div id="content">
				<div class="prep">
                	<div class="simple_cont">
                    	<table>
                            <tr>
                             
                                <td>
                                	<h1>Активация учетной записи</h1>
									
									<p>&nbsp;</p>
                                    <p>
<?php $this->widget('FlashMessages'); ?>


<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		//'validateOnChange'=>true,
		//'validateOnType'=>false,
	),
)); 
?>
<ul>
<li class="clearfix">
<?php echo $form->labelEx($model, 'code'); ?>
<?php echo $form->textField($model, 'code', array('class' => 'text')); ?>
<li><?php echo $form->error($model,'code'); ?></li>
</li>

<div class="alert alert-info">
Код активации был отправлен на адрес электронной почты <?=$user->email?>.
Если Вы не получили письмо с кодом активации в течение часа, отправьте код повторно либо измените адрес электронной почты.
</div>

<div class="form-actions">
<button type="submit" class="btn">Активировать</button>
</div>

<div class="btn-group btn-group-vertical">
<a href="/activation?action=send" class="btn btn-mini">Отправить код активации повторно</a> 
<a href="/support" class="btn btn-mini">Обратиться в службу поддержки</a>
</div>


</ul>
<?php $this->endWidget(); ?>
                                    </p>
                                   
                                </td>
                            </tr>
							
                        </table>
                    </div>
        
                   
                </div>
				

			</div><!-- #content-->
		</div><!-- #container-->

		<div class="sidebar" id="sideLeft">

<? $this->widget('MenuWidget') ?>
			
            
		</div><!-- .sidebar#sideLeft -->