<tr>
<td class="text"><a href="/users/<?=$data->senderdata->username?>"> <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->senderdata->userpic?>" class="avatar" width="70" /></a>
<ul class="ucard">
<li class="black">
<?=$data->senderdata->_tariff?> <?=$data->senderdata->_online?> 
<font class="frlname11"><a href="/users/<?=$data->senderdata->username?>" class="frlname11"><?=$data->senderdata->name?> <?=$data->senderdata->surname?></a> [<a href="/users/<?=$data->senderdata->username?>" class="frlname11"><?=$data->senderdata->username?></a>]</font>
</li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$data->senderdata->username?>/?review=positive">0</a>
</li>
<li><a href="/contacts/send/<?=$data->senderdata->username?>">Личное сообщение</a></li>
</ul>
<br clear="all" /><br clear="all" />

</td>
<td class="rating fr">

<a href="/user/account/invite?id=<?=$data->id?>&action=accept" class="btn btn-mini">Принять</a> 
<a href="/user/account/invite?id=<?=$data->id?>&action=reject" class="btn btn-mini">Отклонить</a> 

</td>

</tr>
