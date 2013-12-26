		<div id="container">
			<div id="content">

				<div class="prep">
                	<div class="simple_cont">
                    	<table>
                            <tr>
                             
                                <td>
                                	<h1><?=$model->title?></h1>
									<h3><?=Date_helper::date_smart($model->date)?></h3>

									<p>&nbsp;</p>
                                    <p><?=$model->text_v?></p>
                                   
                                </td>
                            </tr>
							
                        </table>
                    </div>
        
                   
                </div>
				

			</div><!-- #content-->
		</div><!-- #container-->

		<div class="sidebar" id="sideLeft">
			<div class="left_block">
            	<h3>Личное меню</h3>
                <ul class="left_list">
					<li><a href="#">Выбрать заказ</a></li>
                	<li><a href="#">Профиль</a></li>
                    <li><a href="#">Сообщения (0)</a></li>
                    <li><a href="#">Лента событий (0)</a></li>
                    <li><a href="#">Заработок </a></li>
                </ul>
            </div>
			<div class="left_block">
            	<h3>Мои заказы</h3>
                <ul class="left_list">
                	<li><a href="#">Претендент (2)</a></li>
                    <li><a href="#">В работе (0)</a></li>
                    <li><a href="#">На гарантии (0)</a></li>
                    <li><a href="#">Завершенные (0)</a></li>
					<li><a href="#">Отказали (0)</a></li>
                </ul>
				
            </div>
			<div class="left_block">
            	<h3>Доступно для вывода</h3>
                <strong class="left_val">2450 р.</strong>
                <a href="#" class="sps">ВЫВЕСТИ</a>
            </div>
			
			<div class="left_block">
            	<h3>На гарантии</h3>
                <strong class="left_val">24050 р.</strong>
               
            </div>
			
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