		<div id="container">
			<div id="content">
				<div class="page_title"><h1>Регистрация исполнителя</h1></div>
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
                            <th width="30%">Телефон *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td><input type="" class="inp_text" /></td>
							<td><p> Номер телефона необходим для связи администрации сайта с Вами </p></td>		
						</tr>
						<tr>
                            <th width="30%">Вуз *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td><input type="" class="inp_text" /></td>
							<td><p> Укажите учебное заведение, которое вы закончили </p></td>		
						</tr>
						<tr>
                            <th width="30%">Специальность *:</th>
							<th width="70%"></th>
                        </tr>
						<tr>
							<td><input type="" class="inp_text" /></td>
							<td><p>  </p></td>		
						</tr>
						<tr>
                            <th width="30%">Год окончания ВУЗа *:</th>
							<th width="70%"></th>
                        </tr>
					
						<tr>
							<td><input type="" class="inp_text" /></td>
							<td><p>  </p></td>		
						</tr>
						<tr>
							<th colspan="2">Скан или фотография диплома об образовании</th>
						</tr>
						<tr>
							<td><input type="submit" class="inp_sub" value="ЗАГРУЗИТЬ ФАЙЛ" /></td>
						</tr>
					</table>
					<table>
						<tr>
							<th colspan="4">
							Тип исполняемых работ *:
							</th>
						</tr>
						<tr>
							<td width="25%">
							<input value="1"  type="checkbox" />	Дипломная работа	<br>
							<input value="1"  type="checkbox" />	Курсовая работа	<br>
							<input value="1"  type="checkbox" />	Реферат	<br>
							<input value="1"  type="checkbox" />	Диссертация	<br>
							<input value="1"  type="checkbox" />	Отчёт по практике	

							</td>
							<td width="25%">
							<input value="1"  type="checkbox" />	Статья	<br>
							<input value="1"  type="checkbox" />	Доклад	<br>
							<input value="1"  type="checkbox" />	Рецензия	<br>
							<input value="1"  type="checkbox" />	Контрольные работы	<br>
							<input value="1"  type="checkbox" />	Монография	

							</td>
							<td width="25%">
							<input value="1"  type="checkbox" />	Решение задач	<br>
							<input value="1"  type="checkbox" />	Бизнес-план	<br>
							<input value="1"  type="checkbox" />	Ответы на вопросы	<br>
							<input value="1"  type="checkbox" />	Творческая работа	<br>
							<input value="1"  type="checkbox" />	Эссе	

							</td>
							<td width="25%">
							<input value="1"  type="checkbox" />	Чертёж	<br>
							<input value="1"  type="checkbox" />	Сочинения	<br>
							<input value="1"  type="checkbox" />	Перевод	<br>
							<input value="1"  type="checkbox" />	Презентации	<br>
							<input value="1"  type="checkbox" />	Набор текста	
							</td>
						</tr>
						<tr>
						<td><input value="1"  type="checkbox" />	Другое	</td>
						</tr>
					</table>
					<table>
						<tr>
							<th colspan="2">
							 Список предметов *:
							</th>
						</tr>
						<tr>
							<td width="50%">
							<b>Экономические</b><br>
							<input value="1"  type="checkbox" /> Антикризисное управление	<br>
							<input value="1"  type="checkbox" />	Банковское дело	<br>
							<input value="1"  type="checkbox" />	Бизнес планирование	<br>
							<input value="1"  type="checkbox" />	Бухгалтерский учет и аудит	<br>
							<input value="1"  type="checkbox" />	Внешнеэкономическая деятельность	<br>
							<input value="1"  type="checkbox" />	Гостиничное дело	<br>
							<input value="1"  type="checkbox" />	Государственное и муниципальное управление	<br>
							<input value="1"  type="checkbox" />	Деньги	<br>
							<input value="1"  type="checkbox" />	Инвестиции	<br>
							<input value="1"  type="checkbox" />	Инновационный менеджмент	<br>
							<input value="1"  type="checkbox" />	Кредит	<br>
							<input value="1"  type="checkbox" />	Логистика	<br>
							<input value="1"  type="checkbox" />	Маркетинг	<br>
							<input value="1"  type="checkbox" />	Менеджмент	<br>
							<input value="1"  type="checkbox" />	Менеджмент организации	<br>
							<input value="1"  type="checkbox" />	Микро-, макроэкономика	<br>
							<input value="1"  type="checkbox" />	Налоги	<br>
							<input value="1"  type="checkbox" />	Организационное развитие	<br>
							<input value="1"  type="checkbox" />	Производственный маркетинг и менеджмент	<br>
							<input value="1"  type="checkbox" />	Стандартизация	<br>
							<input value="1"  type="checkbox" />	Статистика	<br>
							<input value="1"  type="checkbox" />	Стратегический менеджмент	<br>
							<input value="1"  type="checkbox" />	Страхование	<br>
							<input value="1"  type="checkbox" />	Таможенное дело	<br>
							<input value="1"  type="checkbox" />	Теория управления	<br>
							<input value="1"  type="checkbox" />	Товароведение	<br>
							<input value="1"  type="checkbox" />	Торговое дело	<br>
							<input value="1"  type="checkbox" />	Туризм	<br>
							<input value="1"  type="checkbox" />	Управление персоналом	<br>
							<input value="1"  type="checkbox" />	Финансовый менеджмент	<br>
							<input value="1"  type="checkbox" />	Финансы	<br>
							<input value="1"  type="checkbox" />	Ценообразование и оценка бизнеса	<br>
							<input value="1"  type="checkbox" />	Эконометрика	<br>
							<input value="1"  type="checkbox" />	Экономика	<br>
							<input value="1"  type="checkbox" />	Экономика предприятия	<br>
							<input value="1"  type="checkbox" />	Экономика труда	<br>
							<input value="1"  type="checkbox" />	Экономическая теория	<br>
							<input value="1"  type="checkbox" />	Экономический анализ	<br>


							</td>
							<td width="50%">
							<b>Гуманитарные</b><br>
							<input value="1"  type="checkbox" />	Библиотечно-информационная деятельность	<br>
							<input value="1"  type="checkbox" />	Ветеринария	<br>
							<input value="1"  type="checkbox" />	Дизайн	<br>
							<input value="1"  type="checkbox" />	Документоведение и архивоведение	<br>
							<input value="1"  type="checkbox" />	Журналистика	<br>
							<input value="1"  type="checkbox" />	Искусство	<br>
							<input value="1"  type="checkbox" />	История	<br>
							<input value="1"  type="checkbox" />	Конфликтология	<br>
							<input value="1"  type="checkbox" />	Культурология	<br>
							<input value="1"  type="checkbox" />	Литература	<br>
							<input value="1"  type="checkbox" />	Международные отношения	<br>
							<input value="1"  type="checkbox" />	Музыка	<br>
							<input value="1"  type="checkbox" />	Педагогика	<br>
							<input value="1"  type="checkbox" />	Политология	<br>
							<input value="1"  type="checkbox" />	Право и юриспруденция	<br>
							<input value="1"  type="checkbox" />	Психология	<br>
							<input value="1"  type="checkbox" />	Реклама и PR	<br>
							<input value="1"  type="checkbox" />	Связи с общественностью	<br>
							<input value="1"  type="checkbox" />	Социальная работа	<br>
							<input value="1"  type="checkbox" />	Социология	<br>
							<input value="1"  type="checkbox" />	Страноведение	<br>
							<input value="1"  type="checkbox" />	Физическая культура	<br>
							<input value="1"  type="checkbox" />	Философия	<br>
							<input value="1"  type="checkbox" />	Хирургия	<br>
							<input value="1"  type="checkbox" />	Этика	<br>
							<input value="1"  type="checkbox" />	Языки (переводы)	<br>
							<input value="1"  type="checkbox" />	Языкознание и филология	<br>

							</td>
						</tr>
						<tr>
							<td width="50%">
							<b>Технические</b><br>
							<input value="1"  type="checkbox" />	Авиационная и ракетно-космическая техника	<br>
							<input value="1"  type="checkbox" />	Автоматизация технологических процессов	<br>
							<input value="1"  type="checkbox" />	Автоматика и управление	<br>
							<input value="1"  type="checkbox" />	Архитектура и строительство	<br>
							<input value="1"  type="checkbox" />	Базы данных	<br>
							<input value="1"  type="checkbox" />	Высшая математика	<br>
							<input value="1"  type="checkbox" />	Геометрия	<br>
							<input value="1"  type="checkbox" />	Гидравлика	<br>
							<input value="1"  type="checkbox" />	Информатика	<br>
							<input value="1"  type="checkbox" />	Информационная безопасность	<br>
							<input value="1"  type="checkbox" />	Информационные технологии	<br>
							<input value="1"  type="checkbox" />	Логика	<br>
							<input value="1"  type="checkbox" />	Материаловедение	<br>
							<input value="1"  type="checkbox" />	Машиностроение	<br>
							<input value="1"  type="checkbox" />	Металлургия	<br>
							<input value="1"  type="checkbox" />	Механика	<br>
							<input value="1"  type="checkbox" />	Начертательная геометрия	<br>
							<input value="1"  type="checkbox" />	Приборостроение и оптотехника	<br>
							<input value="1"  type="checkbox" />	Программирование	<br>
							<input value="1"  type="checkbox" />	Процессы и аппараты	<br>
							<input value="1"  type="checkbox" />	Радиофизика	<br>
							<input value="1"  type="checkbox" />	Сопротивление материалов	<br>
							<input value="1"  type="checkbox" />	Телевидение	<br>
							<input value="1"  type="checkbox" />	Теоретическая механика	<br>
							<input value="1"  type="checkbox" />	Теория вероятности	<br>
							<input value="1"  type="checkbox" />	Теория машин и механизмов	<br>
							<input value="1"  type="checkbox" />	Теплоэнергетика и теплотехника	<br>
							<input value="1"  type="checkbox" />	Технологические машины и оборудование	<br>
							<input value="1"  type="checkbox" />	Технология продовольственных продуктов и товаров	<br>
							<input value="1"  type="checkbox" />	Транспортные средства	<br>
							<input value="1"  type="checkbox" />	Физика	<br>
							<input value="1"  type="checkbox" />	Чертежи	<br>
							<input value="1"  type="checkbox" />	Черчение	<br>
							<input value="1"  type="checkbox" />	Электроника, электротехника, радиотехника	<br>
							<input value="1"  type="checkbox" />	Энергетическое машиностроение	<br>

							</td>
							<td width="50%">
							<b>Естественные</b><br>
							<input value="1"  type="checkbox" />	Астрономия	<br>
							<input value="1"  type="checkbox" />	Безопасность жизнедеятельности	<br>
							<input value="1"  type="checkbox" />	Биология	<br>
							<input value="1"  type="checkbox" />	География	<br>
							<input value="1"  type="checkbox" />	Геодезия	<br>
							<input value="1"  type="checkbox" />	Геология	<br>
							<input value="1"  type="checkbox" />	Естествознание	<br>
							<input value="1"  type="checkbox" />	Медицина	<br>
							<input value="1"  type="checkbox" />	Нефтегазовое дело	<br>
							<input value="1"  type="checkbox" />	Химия	<br>
							<input value="1"  type="checkbox" />	Экология	<br>
							</td>
						</tr>
					</table>
					<table>
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