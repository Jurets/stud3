<?
    $url = Yii::app()->createAbsoluteUrl('sbs/'.$sbsLetter->sbs->id);
?>

Уважаемый(ая) <strong><?=$userTo->nickName?>!</strong><br/>
<br/>
Вам пришло Новое сообщение по проекту <strong><?=$sbsLetter->sbs->project->title?></strong> от пользователя <strong><?=$userFrom->nickName?></strong> 
<br/>
<br/>

Для того, чтобы просмотреть обсужение проекта и новое сообщение, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>