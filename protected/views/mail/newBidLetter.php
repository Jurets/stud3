Уважаемый(ая) <?=$userTo->nickName?>!<br/>
<br/>
Вам пришло Новое сообщение по проекту <?=$bidLetter->bid->tender->title?> от пользователя <?=$userFrom->nickName?> 
<br/>
Текст сообщения:<br/>
<?=$bidLetter->text?>
<br/><br/>
Для того, чтобы просмотреть обсужение проекта и новое сообщение, перейдите по указанной ниже ссылке:<br/>
<a target="_blank" href="<?=$url?>"><?=$url?></a><br/>
<br/>
Если не работает переход по ссылке, скопируйте ее и вставьте в адресную строку браузера.<br/>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>