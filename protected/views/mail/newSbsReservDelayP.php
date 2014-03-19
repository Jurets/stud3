<?
    $url = Yii::app()->params['site'] . '/tenders/' . $tender->id . '.html';
?>
Уважаемый(ая) <strong><?=$performer->nickName?>!</strong><br/>
<br/>                   
Заказчик не зарезервировал необходимую сумму по проекту <strong><?=$tender->title?></strong> <br/>
Сделка сброшена!
<br/><br/>

Для того, чтобы просмотреть заказ, перейдите по ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>

Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>