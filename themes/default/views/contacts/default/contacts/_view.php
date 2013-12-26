<tr>
<td width="15" valign="middle"><input name="contacts[]" value="<?=$data->id?>" type="checkbox" /></td>
<td class="text">
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userdata->userpic?>" alt="" class="avatar" width="70" />
<ul class="ucard">
<li class="utitle">

<?=$data->userdata->_tariff?>

<?=$data->userdata->_online?>

<font class="frlname11"><a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->name?> <?=$data->userdata->surname?></a> [<a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->username?></a>]</font>

</li>
<li><a href="/contacts/send/<?=$data->userdata->username?>">Сообщений</a> (<?=$data->messages?>)</li>
<li>Последнее сообщение: <?=Date_helper::date_smart($data->last_msg)?></li>
<? if( $data->checkNewMessages() ): ?>
<li><div class="row-title"><a href="/contacts/send/<?=$data->userdata->username?>"><strong>Есть новые сообщения</strong></a></div></li>
<? endif; ?>
</ul>
</td>
</tr>