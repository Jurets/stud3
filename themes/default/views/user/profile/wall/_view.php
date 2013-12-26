<li>  
<img class="avatar" src="/application/images/<?=$data->userdata->userpic?>" width="40px;"/>

<div class="status">
<h2><a target="_blank" href="/users/<?=$data->userdata->username?>"><?=$data->userdata->surname?> <?=$data->userdata->name?></a></h2>
<p class="message"><?=$data->title?></p>

<div class="attachment">


<? foreach($data->data as $row): ?> 

<? if( $row['image'] ): ?>
<img src="/application/images/<?=$row['image']?>" class="picture"/>
<? endif; ?>

<div class="attachment-data">

<p class="name"><a target="_blank" href="http://www.fontsquirrel.com/fonts/modern-pictograms"><?=$row['title']?></a></p>

<p class="caption"><?=$row['title']?></p>
<p class="description"><?=$row['descr']?></p>

</div>
<br clear="all" />
<br />

<? endforeach; ?>




</div>



</div>

</li>

<ul class="opt">


<li><?=$data->date?></li>
<!--<li><a class="like active" href="#" title="Нравится" onclick="like(<?=$data->id?>, this); return false;"><?=$data->like?></a></li>-->
</ul>