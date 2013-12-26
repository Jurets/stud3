<tr>
<td class="text"><a href="/users/<?=$data->recipientdata->username?>"> <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->recipientdata->userpic?>" class="avatar" width="70" /></a>
<ul class="ucard">
<li class="black">
<?=$data->recipientdata->_tariff?> <?=$data->recipientdata->_online?> 
<font class="frlname11"><a href="/users/<?=$data->recipientdata->username?>" class="frlname11"><?=$data->recipientdata->name?> <?=$data->recipientdata->surname?></a> [<a href="/users/<?=$data->recipientdata->username?>" class="frlname11"><?=$data->recipientdata->username?></a>]</font>
</li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$data->recipientdata->username?>/?review=positive">0</a>
</li>
<li><a href="/contacts/send/<?=$data->recipientdata->username?>">Личное сообщение</a></li>
</ul>
<br clear="all" /><br clear="all" />

</td>
<td class="rating fr">

<strong><?=$data->getStatus()?></strong>

</td>

</tr>
