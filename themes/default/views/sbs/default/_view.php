<div style="margin-top:10px;">

<div class="row-title"><a href="/blogs/<?=$data->id?>.html"><span class="label label-info"><?=$data->title?></span></a></div>


<div class="row-date"><? if( $data->update ): ?>Отредактировано <? endif; ?><?=Date_helper::date_smart($data->date)?></div>

<div class="row-desc"><?=$data->short_text_v?></div>


<? if( $data->gettags() ): ?>
<div class="row-comments">
<ul class="tags"><i class="icon-tags"></i> <? foreach($data->gettags() as $tag): ?><li><a href="/blogs/?tag=<?=$tag?>"><?=$tag?></a></li> <? endforeach; ?></ul>
</div>
<? endif; ?>


<div class="skip-rating"></div>
<ul class="opt">

<li class="author">
<a href="/users/<?=$data->userdata->username?>"><?=$data->userdata->username?></a>
</li>


<li><a class="views<? if( $data->checkView() ): ?> active<? endif; ?>" href="#" title="Просмотров"><?=$data->views?></a></li>
<li><a class="comments" href="/blogs/<?=$data->id?>.html#comments" title="Комментариев"><?=$data->comments?></a></li>
<li><a class="favorite<? if( $data->checkFavorite() ): ?> active<? endif; ?>" href="#" title="Избранное" onclick="blog.tofavorite(<?=$data->id?>, this); return false;"></a></li>
<li><a class="like<? if( $data->checkLike() ): ?> active<? endif; ?>" href="#" title="Нравится" onclick="blog.like(<?=$data->id?>, this); return false;"><?=$data->like?></a></li>

<li><a href="/blogs/?category=<?=$data->category?>"><?=$data->CategoryName()?></a></li>

</ul>
<div class="skip-rating"></div>

 


</div>