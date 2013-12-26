		<div id="container">
			<div id="content">
				<div class="page_title"><h1>Регистрация заказчика</h1></div>
				<div class="cabinet">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	'focus'=>array($model,'username'),
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => true,
		'validateOnType' => false,
/*
                        //the code below is only to customize the form's user interface
                        'afterValidateAttribute' => 'js:function(form, attribute, data, hasError){
                            if(hasError) alert(1)
                                var temp = $("#"+attribute.inputID+"_em_").html();   
                                 if(temp)
                                    $("#"+attribute.inputID+"_em_").html("<li>"+temp+"</li>");
                            }
                        ',
                        'afterValidate' => 'js:function(form, data, hasError){
                            $.each(data, function(index, value) { 
                                if(index != "__proto"){
                                    var temp = data[index][0];   
                                    $("#"+index+"_em_").html("<li>"+temp+"</li>");
                                }
                            });
                            if(!hasError)
                                return true;    
                        }'
*/
	),
)); 
?>
					<table>
						<tr>
                            <th width="30%">Имя *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td>
<?php echo $form->textField($model,'name', array('class' => 'inp_text')); ?>
<?php echo $form->error($model,'name'); ?>
                            </td>
							<td><p>   Возможно использовать только кириллицу и латиницу </p></td>		
						</tr>
						<tr>
                            <th width="30%">Логин *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td>
<?php echo $form->textField($model,'username', array('class' => 'inp_text')); ?>
<?php echo $form->error($model,'username'); ?>
                            </td>
							<td><p>Минимальное количество символов 3. Максимальное количество символов 15 </p></td>		
						</tr>
						<tr>
                            <th width="30%">Email *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td>
<?php echo $form->textField($model,'email', array('class' => 'inp_text')); ?>
<?php echo $form->error($model,'email'); ?>
                            </td>
							<td><p> Третьи лица не имеют доступ к этой информации </p></td>		
						</tr>
						<tr>
                            <th width="30%">Пол *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td>
<?php echo $form->radioButtonList($model,'gender',array('1'=>'Мужской','2'=>'Женский'), array('separator'=>' ')); ?>
<?php echo $form->error($model,'gender'); ?>
							</td>
							<td><p></p></td>		
						</tr>
						<tr>
                            <th width="30%">Пароль *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td>
<?php echo $form->passwordField($model,'password', array('class' => 'inp_text')); ?>
<?php echo $form->error($model,'password'); ?>
                            </td>
							<td><p>Минимальное количество символов 6. Максимальное количество символов 20 </p></td>		
						</tr>
						<tr>
                            <th width="30%">Повтор пароля *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td>
<?php echo $form->passwordField($model,'password2', array('class' => 'inp_text')); ?>
<?php echo $form->error($model,'password2'); ?>
                            </td>
							<td><p>Минимальное количество символов 6. Максимальное количество символов 20</p></td>		
						</tr>
						<tr>
							<td colspan="2">
<?php echo $form->checkBox($model,'agree',array('value'=>TRUE, 'uncheckValue' => FALSE)); ?>&nbsp; &nbsp; 
<?php echo $form->label($model,'agree'); ?>
<?php echo $form->error($model,'agree'); ?>
							</td>
						</tr>
						
						<tr>
							<td><input type="submit" class="inp_sub" value="РЕГИСТРАЦИЯ" /></td>
						</tr>
                    </table>
<?php $this->endWidget(); ?>
                </div>
				

			</div><!-- #content-->
		</div><!-- #container-->

		<div class="sidebar" id="sideLeft">
<? $this->widget('MenuWidget') ?>
			
			<div class="left_menu">
            	
                <ul>
                	<li><b>КАТАЛОГ АВТОРОВ</b></li>
                    <li><a href="#">Биология и химия</a></li>
                    <li><a href="#">География, геология и геодезия</a></li>
                    <li class="active"><a href="#">Иностранный язык</a>
                    	<ul>
                        	<li><a href="#">Английский язык</a><span>(100)</span></li>
                            <li><a href="#">Французкий язык</a><span>(24)</span></li>
                            <li><a href="#">Немецкий язык</a><span>(41)</span></li>
                            <li><a href="#">Итальянский язык</a><span>(22)</span></li>
                        </ul>
                    </li>
                    <li><a href="#">Информатика и программирование</a></li>
                    <li><a href="#">Краткое содержание произведений</a></li>
                    <li><a href="#">Культура и искусство</a></li>
                    <li><a href="#">Математика, физика, астрономия</a></li>
                    <li><a href="#">Медицина и здоровье</a></li>
                    <li><a href="#">Менеджмент и маркетинг</a></li>
                    <li><a href="#">Москвоведение, краеведение</a></li>
                    <li><a href="#">Наука и техника</a></li>
                    <li><a href="#">Новейшая история, политология</a></li>
                    <li><a href="#">Промышленность, производство</a></li>
                    <li><a href="#">Психология и педагогика</a></li>
                    <li><a href="#">Религия и мифология</a></li>
                    <li><a href="#">СМИ. Издательское дело и полиграфия</a></li>
                    <li><a href="#">Физкультура и спорт</a></li>
                    <li><a href="#">Философия, социология</a></li>
                </ul>
            </div>
            
		</div><!-- .sidebar#sideLeft -->