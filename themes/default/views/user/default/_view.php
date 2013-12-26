<tr>
<td class="text"><a href="/users/<?=$data->username?>"> <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userpic?>" class="avatar" width="70" /></a>

<ul class="ucard">
<li class="black">
<?=$data->_tariff?> <?=$data->_online?> 
<font class="frlname11"><a href="/users/<?=$data->username?>" class="frlname11"><?=$data->name?> <?=$data->surname?></a> [<a href="/users/<?=$data->username?>" class="frlname11"><?=$data->username?></a>]</font> <strong class="grey"><?=$data->getSpecialization()?></strong>
</li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$data->username?>/?review=positive">0</a>
</li>


<ul class="nav nav-list">

<li><a href="/users/invite/<?=$data->username?>"><i class="icon-plus"></i> Добавить в контакты</a></li>

<li><a href="/contacts/send/<?=$data->username?>"><i class="icon-envelope"></i> Написать сообщение</a></li>
</ul>

</ul>

<? if( $data->getTags() ): ?>
    <ul class="tag-list">
<? foreach($data->getTags() as $tag): ?>
<li><a href="#"><?=$tag?></a></li>
<? endforeach; ?>
    </ul>
<? endif; ?>
</td>
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