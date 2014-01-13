<tr>
<td class="title">

<h3><a href="/tenders/<?=$data->id?>.html"><?=$data->title?></a></h3>

<br />

<? if( $data->status == Tenders::STATUS_OPEN ): ?>
<a href="/sbs/publication?id=<?=$data->id?>" class="btn btn-mini">Начать СБС</a> 
<? endif; ?>

<span class="fr grey">
<strong><?=$data->budget?></strong>
</span>

<div>
<br />
<?=$data->text?>
<br /><br />
</div>

<div class="inf grey">
Добавил: <a href="/users/<?=$data->userdata->username?>"><?=$data->userdata->username?></a> | <?=$data->category()?> | <?=Date_helper::date_smart($data->date)?>
</div>

</tr>

<tr>
<td class="txt-small">
<a href="/tenders/<?=$data->id?>.html"><?=$data->adminlink()?></a> (<?=$data->getStatus()?>)

<? if( $data->checkNewBids() ): ?>
<br /><strong><a href="/tenders/<?=$data->id?>.html">Есть новые предложения</a></strong>
<? endif; ?>

<span class="fr">
<i class="icon-pencil"></i> <a href="/tenders/publication?id=<?=$data->id?>">Редактировать</a>
<? if( $data->status == Tenders::STATUS_CLOSE ): ?>
 | <a href="/tenders/management?id=<?=$data->id?>&action=open">Открыть</a>
<? endif; ?>

<? if( $data->status == Tenders::STATUS_OPEN ): ?>
 | <a href="/tenders/management?id=<?=$data->id?>&action=close">Закрыть</a>
<? endif; ?>
</span>
</td>
</tr>
