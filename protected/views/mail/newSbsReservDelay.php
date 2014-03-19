<?  
    $url = Yii::app()->params['site'] . '/sbs/publication/' . $tender->id;
?>
Уважаемый(ая) <strong><?=$tender->userdata->nickName?>!</strong><br/>
<br/>                   
Вы не зарезервировали необходимую сумму в течение суток с момента согласия исполнителя по проекту <strong><?=$tender->title?></strong> <br/>
Сделка сброшена. Выберите нового исполнителя!
<br/><br/>

Для того, чтобы выбрать исполнителя, перейдите по ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>

Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>