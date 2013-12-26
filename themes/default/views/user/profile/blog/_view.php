<div class="blog">
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userdata->userpic?>" alt="Cezaer" class="userpic" />

        <li class="black">
<?=$data->userdata->_tariff?> 
<?=$data->userdata->_online?> 
<font class="frlname11"><a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->name?> <?=$data->userdata->surname?></a> [<a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->username?></a>]</font> <span class="grey"><? if( $data->update ): ?>Отредактировано <? endif; ?><?=Date_helper::date_smart($data->date)?></span>
        </li>


<br />

<div class="row-title"><h3><a href="/blogs/<?=$data->id?>.html"><?=$data->title?></a></h3></div>


<div style="margin-left:60px;">
<div class="row-desc"><?=$data->text_v?></div>
</div>

<div class="skip-rating"></div>
<ul class="opt">
<li><a class="views<? if( $data->checkView() ): ?> active<? endif; ?>" href="#" title="Просмотров"><?=$data->views?></a></li>
<li><a class="comments" href="/blogs/<?=$data->id?>.html#comments" title="Комментариев"><?=$data->comments?></a></li>
<li><a class="favorite<? if( $data->checkFavorite() ): ?> active<? endif; ?>" href="#" title="Избранное" onclick="blog.tofavorite(<?=$data->id?>, this); return false;"></a></li>
<li><a class="like<? if( $data->checkLike() ): ?> active<? endif; ?>" href="#" title="Нравится" onclick="blog.like(<?=$data->id?>, this); return false;"><?=$data->like?></a></li>

<li><a href="/blogs/?category=<?=$data->category?>"><?=$data->CategoryName()?></a></li>

</ul>
<div class="skip-rating"></div>



</div>
