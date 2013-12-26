<tr>
<td class="ordertitleDELETE">
<?=$keywords?>
<h3><a href="/tenders/<?=$data->id?>.html"><?=Text_helper::highlight_phrase($data->title, $_GET['keywords'], '<span style="background-color:#FF9">', '</span>')?></a></h3>

<!--проверяем, есть ли загруженный логотип у пользователя, если есть вставляем-->

<? if( $data->userdata->logo ):?>
<div style="margin:10px;">
<img src="<?=Yii::app()->getModule('user')->logoDir?><?=$data->userdata->logo?>" />
</div>
<? endif; ?>

<div class="fr blue">
<strong class="fr"><?=$data->budget()?></strong>
</div>

<div>
<br />
<?=Text_helper::highlight_phrase($data->descr, $_GET['keywords'], '<span style="background-color:#FF9">', '</span>')?>
</div>

<div class="inf grey">
<? if( $data->type == Tenders::TYPE_VACANCY ): ?>
<strong>Вакансия(<?=$data->country()?>, <?=$data->city()?>)</strong> | 
<? endif; ?>
<? if( $data->type == Tenders::TYPE_TENDER ): ?>
<strong>Конкурс(Осталось: <?=Date_helper::Date_await($data->date_end)?>)</strong> | 
<? endif; ?>

<?=$data->category()?> | <?=Date_helper::date_smart($data->date)?>
</div>

<div class="inf blue">
<a href="/tenders/<?=$data->id?>.html"><?=$data->link()?></a>
</div>
</td>
</tr>