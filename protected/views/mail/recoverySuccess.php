<?
    $url = Yii::app()->createAbsoluteUrl('/account/changepassword');
?>

<h3>Сброс пароля</h3>
<p>По Вашему вашему запросу был изменен пароль на <?=CHtml::encode(Yii::app()->name)?></p>
<p>Ваш логин: <?=$data->username?></p>
<p>Временный пароль: <?=$password?></p>
<p>Рекомендуем зайти на сайт и сменить пароль - <a target="_blank" href="<?=$url?>"><?=$url?></a></p>
<hr/>
<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>