Уважаемый(ая) <?=$customer->nickName?>!<br/>
<br/>
На размещенный Вами заказ поступило новое предложение от пользователя <?=$bid->userdata->nickName?> 
Предложение
Стоимость от <?=$bid->budget_start?> до <?=$bid->budget_end?> <?=$bid->currency?>
Сроки от <?=$bid->period_start?> до <?=$bid->period_end?> <?=$bid->periodby?>
Для того, чтобы просмотреть свой заказ и предложения по нему, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>