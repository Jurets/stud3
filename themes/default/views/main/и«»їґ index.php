<div id="yui-main">
<div class="yui-b clearfix"> 



<div class="yui-gc">

<div class="yui-u first">

<div class="lighter">

<form action="/search" method="get">
<input type="hidden" name="type" id="action" value="projects" />
<select id="selectsearch" class="search square">
<option value="projects" selected="selected">Проекты</option>
<option value="items">Работы</option>
<option value="users">Люди</option>
</select>
<span><input type="text" name="keywords" class="search square"> <button type="submit" class="btn">Поиск</button></span>
</form>

</div>
      



            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#tabarticles" data-toggle="tab">Новые статьи</a></li>
              <li><a href="#tabblogs" data-toggle="tab">Популярные блоги</a></li>
              <li><a href="#tabitems" data-toggle="tab">Новые работы</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="tabarticles">
<? foreach($articles as $data): ?>
<div style="margin-top:10px;">

<img src="<?=Yii::app()->getModule('articles')->articlesDir?><?=$data->preview?>" alt="" width="100" class="post-img" />

<div class="row-title"><h3><a href="/articles/<?=$data->id?>.html"><?=$data->title?></a></h3></div>



<div class="row-date"><?=Date_helper::date_smart($data->date)?></div>

<div class="row-descDELETE"><?=$data->short_text_v?></div>

<br clear="all" />

</div>
<? endforeach; ?>
<span class="fr"><strong><a href="/articles">Все статьи</a></strong></span>
              </div>
              <div class="tab-pane fade" id="tabblogs">
<? foreach($blogs as $data): ?>
<div style="margin-top:10px;">

<div class="row-title"><h3><a href="/blogs/<?=$data->id?>.html"><?=$data->title?></a></h3></div>

<div class="row-date"><?=Date_helper::date_smart($data->date)?></div>

<div class="row-descDELETE"><?=$data->short_text_v?></div>

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
<? endforeach; ?>
<span class="fr"><strong><a href="/blogs">Все блоги</a></strong></span>
              </div>
              <div class="tab-pane fade" id="tabitems">
<div class="btn-toolbar">
<div class="btn-group">
<a href="#" class="btn btn-mini active" id="all">Смотреть все</a> 
<a href="#" class="btn btn-mini" id="template">Смотреть только шаблоны</a> 
<a href="#" class="btn btn-mini" id="script">Смотреть только скрипты</a>
</div>
</div>
<ul class="item-list" style="border:none;">
<? foreach($templates as $row): ?>
<li class="web-template <?=$row->type?>">

<div class="thumbnail">
<a href="/items/<?=$row->id?>.html"><img src="<?=Yii::app()->getModule('items')->itemsDir?><?=$row->thumbnail?>" border="0" alt="<?=$row->title?>" title="<?=$row->title?>" /></a>
</div>

<span class="fr"><strong><?=$row->cost?> <span class="abbr">рублей</span></strong></span> 

<div class="item-info">

<h3><a href="/items/<?=$row->id?>.html"><?=$row->title?></a></h3>



</div>


</li>
<? endforeach; ?>
</ul>
<span class="fr"><strong><a href="/items">Все работы</a></strong></span>
              </div>
          </div>

<br clear="all" />


<h1>Удаленная работа <a title="Подписаться на новые проекты" href="/rss/projects"><img width="16" height="16" alt="Подписаться на новые проекты" src="/images/rss.png"></a></h1>

<ul class="nav nav-tabs">
<li class="active"><a href="#">Все</a></li>
<li><a href="/tenders?type=1">Проекты</a></li>
<li><a href="/tenders?type=2">Вакансии</a></li>
<li><a href="/tenders?type=3">Конкурсы</a></li> 
</ul>

<a class="btn fr" href="/tenders/publication"><strong>Опубликовать проект</strong></a>

<table class="listorder">



<? foreach($projects as $data): ?>
<tr>
<td class="ordertitleDELETE">



<h3><a href="/tenders/<?=$data->id?>.html"><?=$data->title?></a></h3>

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
<?=$data->descr?>
<br /><br />
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
<? endforeach; ?>
<tr>
<td class="fr"><a href="/tenders">Смотреть все</a></td>
</tr>
</table> 

</div><!-- /yui-u -->


<div class="yui-u">
			<div class="aside">
				<h2>Сейчас обсуждают</h2>
<? foreach($lived as $row): ?>
				<ul class="discussion">
					<li><a href="/users/<?=$row['username']?>"><?=$row['username']?></a></li>
					<li><a href="/blogs/<?=$row['blog_id']?>.html"><?=$row['title']?></a></li>
					<li class="last"><a href="/blogs/<?=$row['blog_id']?>.html#comment<?=$row['id']?>"><?=Text_helper::character_limiter($row['text'], 128)?></a><a href="/blogs/<?=$row['blog_id']?>.html" class="amount"><?=$row['comments']?></a></li>
				</ul>
<? endforeach; ?>
			</div>
</div><!-- /yui-u -->



</div>
<!-- /yui-gb -->





</div>
</div>

<div id="sidebar" class="yui-b">
<div class="mainbd clearfix">

<? if( $news ): ?>
<div class="sideblock">
<h3>Новости сервиса</h3>
<ul class="latest-page">
<? foreach($news as $row): ?>
<li><?=Date_helper::date_smart($row->date)?> | <a href="/news/<?=$row->id?>.html"><?=$row->title?></a></li>
<? endforeach; ?>
</ul>
</div>
<? endif; ?>


<div class="sideblock">

<!--
<div id="poll-block">
  <h3>Опрос</h3>
  <div class="poll">
    <div class="title">А какая причина бойни в &quot;Ригле&quot; кажется вам самой правдоподобной?</div>
    
<div class="text">Неразделенная любовь</div>
<div class="bar">
  <div style="width: 4%;" class="foreground"></div>
</div>
<div class="percent">
  4%
</div>

<div class="text">Безумие</div>
<div class="bar">
  <div style="width: 42%;" class="foreground"></div>
</div>
<div class="percent">
  42%
</div>

<div class="text">Ненависть к людям</div>
<div class="bar">
  <div style="width: 32%;" class="foreground"></div>
</div>
<div class="percent">
  32%
</div>

<div class="text">Строгая корпоративная культура в компании</div>
<div class="bar">
  <div style="width: 7%;" class="foreground"></div>
</div>
<div class="percent">
  7%
</div>

<div class="text">Это однозначно алкоголь</div>
<div class="bar">
  <div style="width: 15%;" class="foreground"></div>
</div>
<div class="percent">
  15%
</div>
    <div class="total">
      <div class="votes">голосовало: 12861</div>
    </div>
  </div>
  <div class="enddiv"></div>

</div>

-->


<div id="poll-block">
  <h3>Опрос</h3>
  <div class="poll">
    <div class="vote-form">
      <div class="choices">
          <div class="title">А какая причина бойни в &quot;Ригле&quot; кажется вам самой правдоподобной?</div>

        <div class="form-radios"><div class="form-item" id="edit-choice-0-wrapper">
 <label class="option" for="edit-choice-0"><input type="radio" id="edit-choice-0" name="choice" value="0"   class="form-radio" /> Неразделенная любовь</label>
</div>
<div class="form-item" id="edit-choice-1-wrapper">
 <label class="option" for="edit-choice-1"><input type="radio" id="edit-choice-1" name="choice" value="1"   class="form-radio" /> Безумие</label>
</div>
<div class="form-item" id="edit-choice-2-wrapper">
 <label class="option" for="edit-choice-2"><input type="radio" id="edit-choice-2" name="choice" value="2"   class="form-radio" /> Ненависть к людям</label>

</div>
<div class="form-item" id="edit-choice-3-wrapper">
 <label class="option" for="edit-choice-3"><input type="radio" id="edit-choice-3" name="choice" value="3"   class="form-radio" /> Строгая корпоративная культура в компании</label>
</div>
<div class="form-item" id="edit-choice-4-wrapper">
 <label class="option" for="edit-choice-4"><input type="radio" id="edit-choice-4" name="choice" value="4"   class="form-radio" /> Это однозначно алкоголь</label>
</div>
</div>      </div>
      <input type="submit" name="op" id="edit-vote" value="Голосовать"  class="form-submit" />

      <div class="votes">голосовало: 12863</div>
    </div>
        <input type="hidden" name="form_build_id" id="form-139cdac0f6f6e772ea07ba2317293868" value="form-139cdac0f6f6e772ea07ba2317293868"  />
<input type="hidden" name="form_id" id="edit-poll-view-voting" value="poll_view_voting"  />
<input type="hidden" name="ajax_url" id="edit-ajax-url" value="/poll/ajax/vote/200522/1/1"  />
<input type="hidden" name="ajax_text" id="edit-ajax-text" value="Голосование..."  />
  </div>
  <div class="enddiv"></div>

</div>



</div>


<div class="sideblock">
<h3>Проекты</h3>
<div class="main">
<?
$categories = Categories::getCategories();
?>
<ul id="menu">
<? foreach ($categories[0] as $CatId => $CatName ): ?>
            	<li class="drop-bt"><a href="#"><?=$CatName?></a></li>
<ul class="drop-menu">
<? foreach ($categories[$CatId] as $ItemId => $ItemName): ?>
				
				<li class="second"><a href="/tenders?category=<?=$ItemId?>" class="second"><?=$ItemName?></a></li>

<? endforeach; ?>
</ul>
                
  
<? endforeach; ?>
</ul>
</div>
</div>

</div>
</div>
<style type="text/css">
ul#menu .drop-menu:nth-of-type(1)
{
 display:block;
} 
</style>
<script type="text/javascript">
	$('ul#menu li.drop-bt:first').addClass('current');
/* Top */
	$("#top ul").jcarousel({
		scroll:1
	});
</script>