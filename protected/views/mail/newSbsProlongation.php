<?
    $url = Yii::app()->createAbsoluteUrl('sbs/'.$sbs->id);
?>

Уважаемый(ая) <strong><?=$userTo->nickName?>!</strong><br/>
<br/>
Заказчик продлил сроки по проекту <strong><?=$sbs->project->title?></strong>. Данные о сделке:<br/>
Дата создания <?=Date_helper::date_smart($model->date)?><br/>
период (дней): <?=$model->period?><br/>
сумма сделки (рублей): <?=$model->amount?><br/>
<br/>

Для того, чтобы просмотреть информацию по проекту, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>