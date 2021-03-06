<?
    $url = Yii::app()->createAbsoluteUrl('sbs/' . $sbs->id);
?>
Уважаемый(ая) <strong><?=$sbs->performer->nickName?>!</strong><br/>
<br/>
Заказчик <strong><?=$sbs->customer->nickName?></strong> оплатил заказ по проекту <strong><?=$sbs->project->title?></strong></br>
Вы можете приступать к выполнению заказа<br/><br/>

Для того, чтобы просмотреть сделку, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>