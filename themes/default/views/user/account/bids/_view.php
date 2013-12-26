<tr>
<td class="title">

<h3><a href="/tenders/<?=$data->tender->id?>.html"><?=$data->tender->title?></a></h3>

<span class="fr grey">
<strong><?=$data->budget()?></strong>
</span>

<div>
<br />
<?=$data->tender->text?>
<br /><br />
</div>

<span class="inf grey fl">
Добавил: <a href="/users/<?=$data->tender->userdata->username?>"><?=$data->tender->userdata->username?></a> | <?=Date_helper::date_smart($data->tender->date)?>
</span>

<span class="fr">

<span class="subtitle"><?=$data->getStatus()?> | <? if( $data->reading ): ?>Прочитано <?=Date_helper::date_smart($data->reading)?><? else: ?>Не прочитано<? endif; ?></span>
</span>
</tr>