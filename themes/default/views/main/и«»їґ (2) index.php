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



<div class="row-date"><?=Date_helper::date_smart($d