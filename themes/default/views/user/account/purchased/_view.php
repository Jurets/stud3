<tr>
<td class="title"><?=$data->item->title?></td>
<td class="owner txtc"><?=Date_helper::date_smart($data->date)?></td>
<td class="state txtc fr">
<a href="/user/account/downloadfile?id=<?=$data->item_id?>" class="btn btn-mini"><i class="icon-download-alt"></i> Скачать</a>
<a href="#" class="btn btn-mini" onclick="items.email(<?=$data->item_id?>)"><i class="icon-envelope"></i> Отправить на почту</a>
</td>
</tr>