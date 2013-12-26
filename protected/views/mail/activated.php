<h3>Добро пожаловать!</h3>
<p>Вы подтвердили регистрацию на сайте <?=CHtml::encode(Yii::app()->name)?></p>
<p>Учетные данные - логин: <?=$data->username?> email: <a target="_blank" href="mailto:<?=$data->email?>"><?=$data->email?></a></p>
<p>Ваш личный кабинет: <a target="_blank" href="<?=Yii::app()->params['site']?>/account/"><?=Yii::app()->params['site']?>/account/</a></p>
<p>Желаем успешной работы.</p>
<hr/>
<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>