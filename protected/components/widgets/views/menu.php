<?php if( Yii::app()->user->getType() == User::TYPE_CUSTOMER ): ?>
			<div class="left_block">
            	<h3>Личное меню</h3>
                <ul class="left_list">
					<li><a href="/">Заказать работу</a></li>
                	<li><a href="/account/profile">Профиль</a></li>
                    <li><a href="/contacts">Сообщения (0)</a></li>
                    <li><a href="#">Лента событий (0)</a></li>
                    <li><a href="#">Заработок </a></li>
                </ul>
            </div>
			<div class="left_block">
            	<h3>Мои заказы</h3>
                <ul class="left_list">
                	<li><a href="#">В аукционе (2)</a></li>
                    <li><a href="#">В работе (0)</a></li>
                    <li><a href="#">На гарантии (0)</a></li>
                    <li><a href="#">Завершенные (0)</a></li>
					<li><a href="#">Отмененные (0)</a></li>
                </ul>
				
            </div>
<? else: ?>
			<div class="left_block">
            	<h3>Личное меню</h3>
                <ul class="left_list">
					<li><a href="/tenders">Выбрать заказ</a></li>
                	<li><a href="/account/profile">Профиль</a></li>
                    <li><a href="/contacts">Сообщения (0)</a></li>
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
                <strong class="left_val"><?php echo $user->balance; ?> р.</strong>
                <a href="#" class="sps">ВЫВЕСТИ</a>
            </div>
			
			<div class="left_block">
            	<h3>На гарантии</h3>
                <strong class="left_val"><?php echo $user->balance; ?> р.</strong>
               
            </div>

<?php endif; ?>