		<div id="container">
			<div id="content">

				<div class="prep">
                	<div class="simple_cont">
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
                    	<table>
                            <tr>
                                 <td colspan="2">
                                	<h1>Восстановление пароля</h1>
									<h3>Чтобы восстановить пароль, выполните нижеследуюшее предписание</h3>
									<p>&nbsp;</p>
                                    <p>1. Введите ваш email</p>
									<p>2. Вы получите сообщение на ваш email адрес с ссылкой в теле письма. Кликните на нее, чтобы войти</p>
									<p>3. Затем, войдите в ваш профиль и установите новый пароль</p>
								</td>
                            </tr>
							<tr>
								<td width="30%">
<?php echo $form->labelEx($model, 'email'); ?>
<?php echo $form->textField($model, 'email', array('class' => 'inp_text')); ?>
<?php echo $form->error($model,'email'); ?>
                                </td><td width="70%"></td>
							</tr>
							<tr>
								<td><input type="submit" class="inp_sub" value="ОТПРАВИТЬ" /></td><td width="70%"></td>
							</tr>
                        </table>
<?php $this->endWidget(); ?>
                    </div>
        
                   
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