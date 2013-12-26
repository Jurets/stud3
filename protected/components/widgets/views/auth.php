<? if( Yii::app()->user->isAuthenticated() ): ?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => '#')); ?>
            	<h3>Добро пожаловать, <?php echo $user->username; ?>!</h3>
<ul>
<li><a href="/account/profile">Аккаунт</a></li>
<li><a href="/logout">Выход</a></li>
</ul>
<?php $this->endWidget(); ?>
<? else: ?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => '/login')); ?>
            	<h3>Для клиентов</h3>
<input class="authtext" type="text" name="LoginForm[username]" size="12" maxlength="32" />
<input class="authtext" type="text" name="LoginForm[password]" size="12" maxlength="32" />
                <input type="submit" value="" />
                <ul>
                	<li><a href="/registration">Регистрация (Заказчик)</a></li>
                	<li><a href="/registration2">Регистрация (Исполнитель)</a></li>
                    <li><a href="/recovery">Напомнить пароль</a></li>
                </ul>
<?php $this->endWidget(); ?>
            

<? endif; ?>