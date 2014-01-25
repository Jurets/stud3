<?
    //$url = Yii::app()->createAbsoluteUrl('sbs/show/', array('id'=>$sbs->id));
    $url = Yii::app()->createAbsoluteUrl('sbs/' . $sbs->id);
?>
Уважаемый(ая) <strong><?=$sbs->performer->nickName?>!</strong><br/>
<br/>
Вам предложили сделку по проекту <strong><?=$sbs->project->title?></strong> от пользователя <strong><?=$sbs->customer->nickName?></strong>
<ul>
    <li>сумма сделки: <?=$sbs->amount?></li>
    <li>период (дней): <?=$sbs->period?></li>
</ul>
<br/><br/>

Для того, чтобы просмотреть сделку, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>