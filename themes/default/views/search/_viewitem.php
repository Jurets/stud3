<li class="web-template">

<div class="thumbnail">
<a href="/items/<?=$data->id?>.html">
<img src="<?=Yii::app()->getModule('items')->itemsDir?><?=$data->thumbnail?>" border="0" alt="<?=$data->title?>" title="<?=$data->title?>" />
 </a>
</div>

        <div class="item-info">
          <h3>
            <a href="/items/<?=$data->id?>.html"><?=$data->title?></a>
          </h3>
   
          <a href="/users/<?=$data->userdata->username?>" class="author"><?=$data->userdata->username?></a>

<small class="meta">
<span class="meta-categories">Стадия <a href="/items?stage=<?=$data->template->stage?>"><?=$data->template->stage?></a></span><br />
<span class="meta-categories"><?=$data->Category()?></span><br />



<? if( $data->checkFile() ): ?>
<span class="meta-categories">&#10004; Товар загружен</span><br />
<? endif; ?>

<span class="meta-categories">
<? if( $data->template->columns ): ?>
Колонок: <?=$data->template->columns?>
<? endif; ?>
<br />
<? if( $data->template->compatible ): ?>
Поддержка браузеров: <?=$data->template->compatible?>
<? endif; ?>

</span>
</small>

        </div>



        <div class="sale-info">
          <small class="price"><?=$data->cost?> <span class="abbr">рублей</span></small>
        </div>
      </li>