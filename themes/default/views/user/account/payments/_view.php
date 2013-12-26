<tr>
<td class="txtc"><a href="/account/payments/<?=$data->id?>.html"><?=$data->id?></a></td>
<td class="txtc"><?=Date_helper::date_smart($data->date)?></td>
<td class="budget txtc"><strong><?=$data->amount?> рублей</strong></td>
<td class="owner txtc"><a href="/users/<?=$data->userdata->username?>/"><?=$data->userdata->username?></a></td>
<td class="owner txtc"><a href="/users/<?=$data->recipient->username?>/"><?=$data->recipient->username?></a></td>
<td class="state txtc"><?=$data->getStatus()?></td>
</tr>