<?
    $url = Yii::app()->createAbsoluteUrl('/user/recoveryPassword/?code='.$recovery->code);
?>

Уважаемый(ая) <?=$data->name?> <?=$data->surname?>!<br/>
<br/>
Это письмо автоматически отправлено с сайта <a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a>, так-как кто то (возможно вы) сделал Запрос на восстановление забытого логина или пароля для e-mail <a href="mailto:<?=$data->email?>"><?=$data->email?></a>.<br/>
<br/>
ЕСЛИ ВЫ НЕ ДЕЛАЛИ ЗАПРОС, просто проигнорируйте это сообщение.<br/>
<br/>
Ваш логин на <?=CHtml::encode(Yii::app()->name)?>: <?=$data->username?>!<br/>

Для того, чтобы сбросить пароль, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Данная ссылка действительна в течение одних суток.<br/>
Если при переходе по ссылке выдаётся сообщение 'Запрос с указанным идентификатором не найден', то скопируйте ссылку и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>