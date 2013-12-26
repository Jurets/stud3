<tr>
<td class="title"><?=Date_helper::date_smart($data->date)?></td>
<td class="budget txtc"><strong><?=$data->amount?></strong> рублей</td>
<td class="owner txtc"><?=$data->purse?></td>
<td class="state txtc"><?=$data->getStatus()?></td>
</tr>