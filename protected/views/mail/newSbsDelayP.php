<?
    $url = Yii::app()->createAbsoluteUrl('sbs/'.$sbs->id);
?>

Уважаемый(ая) <strong><?=$userTo->nickName?>!</strong><br/>
<br/>
Исполнитель не успел выполнить работу в указанные сроки по проекту <strong><?=$sbs->project->title?></strong>.
<br/>
Вы можете продлить сроки исполнения заказа или отказаться от заказа!
<br/>

Для того, чтобы просмотреть информацию по проекту, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>