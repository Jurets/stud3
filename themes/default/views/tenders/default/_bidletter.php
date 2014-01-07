<div class="bidletter">
    <div class="post_meta meta_type_line">        
        <div class="post_author">
            <i class="icon-user"></i>
            <a rel="author" title="<?=$letter->userdata->username?>" href="<?=Yii::app()->createAbsoluteUrl('users/'.$letter->userdata->username)?>"><?=$letter->userdata->username?></a>
        </div>
        <div class="post_date">
            <i class="icon-calendar"></i>
            <time datetime="2013-02-14T20:26:57"><?=Date_helper::date_smart($letter->date)?></time>
        </div>
    </div>
    <div class="post-author_desc">
        <?=$letter->text?>
    </div>
</div>