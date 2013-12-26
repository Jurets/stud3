<tr>
<td class="text"><a href="/users/<?=$data->frienddata->username?>"> <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->frienddata->userpic?>" class="avatar" width="70" /></a>
<ul class="ucard">
<li class="black">
<?=$data->frienddata->_tariff?> <?=$data->frienddata->_online?> 
<font class="frlname11"><a href="/users/<?=$data->frienddata->username?>" class="frlname11"><?=$data->frienddata->name?> <?=$data->frienddata->surname?></a> [<a href="/users/<?=$data->frienddata->username?>" class="frlname11"><?=$data->frienddata->username?></a>]</font> <strong class="grey"><?=$data->frienddata->getSpecialization()?></strong>
</li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$data->frienddata->username?>/?review=positive">0</a>
</li>
<li><a href="/contacts/send/<?=$data->frienddata->username?>">Личное сообщение</a></li>

<li></li>
</ul>
<br clear="all" /><br clear="all" />

</td>
<td class="rating fr">

</td>

</tr>
