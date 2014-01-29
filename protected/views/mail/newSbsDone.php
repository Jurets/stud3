<?
    $url = Yii::app()->createAbsoluteUrl('sbs/'. $sbs->id);
?>
Уважаемый(ая) <strong><?=$sbs->customer->nickName?>!</strong><br/>
<br/>
Исполнитель <strong><?=$sbs->performer->nickName?></strong> сдал работу по проекту <strong><?=$sbs->project->title?></strong>
<br/><br/>

Для того, чтобы просмотреть сделку, перейдите по ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>

Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>