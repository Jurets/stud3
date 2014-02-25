Уважаемый(ая) <strong><?=$customer->nickName?>!</strong>
<br/>
На размещенный Вами заказ поступило новое предложение от пользователя <strong><?=$bid->userdata->nickName?></strong>
<br/>
Предложение<br/>
Стоимость <strong><?=$bid->budget_start?> <?=$bid->getCurrency()?></strong>
<br/><br/>

Сроки от <strong><?=date('d.m.Y', $bid->period_start)?></strong> до <strong><?=date('d.m.Y', $bid->period_end)?></strong><br/>
<?=$bid->text?>
<br/><br/>

Для того, чтобы просмотреть свой заказ и предложения по нему, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>