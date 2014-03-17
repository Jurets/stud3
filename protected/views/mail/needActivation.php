<?
    $url = Yii::app()->createAbsoluteUrl('/activation?code='.$data->activation_code);
?>

Здравствуйте, <?=$data->surname?> <?=$data->name?>.<br/>
<br/>
Для активации учётной записи, пожалуйста, перейдите по ссылке:<br />
<br />
<a target="_blank" href="<?=$url?>"><?=$url?></a>
<br/>

Код активации: <?=$data->activation_code?>
<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>