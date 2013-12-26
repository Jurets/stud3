<tr>
<td class="title"><?=$data->purse?></td>
<td class="budget txtc"><?=$data->amount?> рублей</td>
<td class="owner txtc"><?=Date_helper::date_smart($data->date)?></td>
<td class="owner txtc"><?=$data->last_operation?></td>
<td><span class="fr"><a href="/account/deletepurse?id=<?=$data->id?>">Удалить</a></span></td>
</tr>