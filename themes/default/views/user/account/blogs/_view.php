<tr>
<td class="ordertitle"><a href="/blogs/<?=$data->id?>.html"><?=$data->title?></a><br>

<div class="inf"><?=$data->CategoryName()?> | <?=Date_helper::date_smart($data->date)?></div>

<div class="inf"><a href="/blogs/publication/<?=$data->id?>">Редактировать</a> | <a href="/blogs/delete/<?=$data->id?>">Удалить</a></div>
</td>
</tr>