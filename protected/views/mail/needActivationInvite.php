<? $url = Yii::app()->params['site'].'/activation?code='.$data->activation_code; ?>

Здравствуйте, <?=$data->surname?> <?=$data->name?>, вы были зарегистрированы в сети удаленных специалистов Fnetwork.ru по приглашению.<br/>
<br/>
Получены 3 кода приглашения:<br />
<? foreach($invites as $row): ?>
<?=$row['code']?><br />
<? endforeach; ?>
<br />
Для активации учётной записи, пожалуйста, перейдите по ссылке:<br />
<br />
<a target="_blank" href="<?=$url?>"><?=$url?></a>
<br/>

Код активации: <?=$data->activation_code?>
<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>