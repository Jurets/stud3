Уважаемый(ая) <strong><?=$customer->nickName?>!</strong>
<br/>
На размещенный Вами заказ поступило новое предложение от пользователя <strong><?=$bid->userdata->nickName?></strong>
<br/>
Предложение<br/>
Стоимость от <strong><?=$bid->budget_start?> до <?=$bid->budget_end?> <?=$bid->getCurrency()?></strong>
<br/><br/>

Сроки от <strong><?=$bid->period_start?> до <?=$bid->period_end?> <?=$bid->getPeriodby()?></strong><br/>
<?=$bid->text?>
<br/><br/>

Для того, чтобы просмотреть свой заказ и предложения по нему, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>