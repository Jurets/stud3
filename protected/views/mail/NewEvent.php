Здравствуйте, <?=$user['name']?> <?=$user['surname']?>!<br/>
<p>У вас есть новые события..</p>
<hr/>
<p><?=$title?></p>
<hr/>
<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>

<hr/>
Вы можете отключить уведомления различных типов событий на странице «Аккаунт/Оповещения» вашего аккаунта.