<tr>


<td class="thumb" rowspan="3" style="width:230px;">
<a href="#portfolio<?=$data->id?>" onclick="portfolio.open(<?=$data->id?>);"><img src="<?=Yii::app()->getModule('portfolio')->portfolioDir?><?=$data->preview?>" title="<?=$row['title']?>" width="200" /></a>

</td>

<td class="info">
<h4><a href="#portfolio<?=$data->id?>" onclick="portfolio.open(<?=$data->id?>);"><?=$data->title?></a></h4>
<ul class="opt">
<li><a class="views active" href="#" title="Просмотров"><?=$data->views?></a></li>
<li><a class="comments" href="#" title="Комментариев"><?=$data->comments?></a></li>
<li><a class="like<? if( $data->checkLike() ): ?> active<? endif; ?>" href="#" title="Нравится" onclick="portfolio.like(<?=$data->id?>, this); return false;"><?=$data->like?></a></li>
</ul>
</td>

</tr>

<tr>
<td>
<p><?=$data->text?></p>
</td>
</tr>



<tr>
<td>Дата: <?=Date_helper::date_smart($data->date)?></td>
</tr>

<tr>
<td></td>
</tr>


<tr>

<td class="options" colspan="2">
<span class="fl">
<label><input type="checkbox" onchange="portfolio.main(<?=$data->id?>, this)"<? if( $data->main ): ?> checked="checked"<? endif; ?> /> <strong>показывать в каталоге</strong></label>
</span>


<span class="fr">
<a href="/portfolio/publication?id=<?=$data->id?>">Редактировать</a> |
<a href="/portfolio/delete?id=<?=$data->id?>">Удалить</a>
</span>
</td>
</tr>