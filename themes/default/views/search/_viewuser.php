<tr>
<td class="text"><a href="/users/<?=$data->username?>"> <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userpic?>" class="avatar" width="70" /></a>
<ul class="ucard">
<li class="utitle">

<font class="frlname11"><a href="/users/<?=$data->username?>" class="frlname11"><?=$data->name?> <?=$data->surname?></a> [<a href="/users/<?=$data->username?>" class="frlname11"><?=$data->username?></a>]</font>

<li><?=$data->_online?>  <?=$data->_tariff?></li>
</li>
</ul>
</td>
<td class="rating"><?=$data->rating?></td>
<td class="rating"><a href="/users/items/<?=$data->username?>"><?=$data->static->items?></a></td>
<td class="rating"><a href="/users/reviews/<?=$data->username?>"><?=$data->static->reviews_positive?></a></td>
<td class="rating"><a href="/users/portfolio/<?=$data->username?>"><?=$data->static->portfolio?></a></td>
<td class="rating"><a href="/users/favorites/<?=$data->username?>"><?=$data->static->favorites?></a></td>
</tr>
<? if( $portfolio = Portfolio::getTop($data->id) ): ?>
<tr>
<td colspan="6">
	<ul class="thumbnails">
<? foreach($portfolio as $row): ?>
        <li class="span3">
          <div class="thumbnail">
            <img src="<?=Yii::app()->getModule('portfolio')->portfolioDir?><?=$row['preview']?>" alt="" onclick="portfolio.open(<?=$row['id']?>);">
            <div class="caption">
              <h5><?=$row['title']?></h5>
            </div>
          </div>
        </li>
<? endforeach; ?>
      </ul>

<strong><a href="/users/portfolio/<?=$data->username?>">Все работы пользователя (<?=$data->static->portfolio?>)</a></strong>

</td>
</tr>
<? endif; ?>