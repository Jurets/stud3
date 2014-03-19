<?
    $url1 = Yii::app()->createAbsoluteUrl('sbs/reserve/'.$sbs->id);
    $url2 = Yii::app()->createAbsoluteUrl('account/balance/');
?>
Уважаемый(ая) <strong><?=$sbs->customer->nickName?>!</strong><br/>
<br/>
Исполнитель <strong><?=$sbs->performer->nickName?></strong> согласился на Ваше предложение по проекту <strong><?=$sbs->project->title?></strong>
<br/>
Сумма, необходимая для выполнения работы: <strong><?=$sbs->amount?></strong>
<br/>
На резервирование денег Вам отводятся сутки. В случае не резервирования денег в течении суток, сделка будет сброшена
<br/><br/>

Для того, чтобы зарезервировать деньги на сделку, выполните вход на сайте и перейдите по ссылке:<br/>
<a target="_blank" href="<?=$url1?>"><?=$url1?></a><br/>
Для того, чтобы пополнить свой баланс, выполните вход на сайте и перейдите по ссылке:<br/>
<a target="_blank" href="<?=$url2?>"><?=$url2?></a><br/>
<br/>

Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>