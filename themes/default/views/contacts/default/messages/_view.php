<div class="answer">
<div class="com-title">
Добавил <a rel="nofollow" href="/users/<?=$data->userdata->username?>"><?=$data->userdata->username?></a>

<?=Date_helper::date_smart($data['date'])?>

<span class="fr">
<? if( $data['reading'] ): ?>
Прочитано: <?=Date_helper::date_smart($data['reading'])?>
<? else:?>
Не прочитано
<? endif; ?>
</span>

</div>

<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userdata->userpic?>" alt="<?=$data->userdata->username?>" class="userpic" />
<div class="com-text"><?=nl2br($data['text'])?></div>



</div>

<? if( $data->files ): ?>
<div>
<ul class="qq-upload-list">
<? foreach ( $data->files as $row ): ?>
<li class="qq-upload-success">
<span class="qq-upload-file"><a href="<?=Yii::app()->getModule('contacts')->messagesAttachmentsDir?><?=$row['name']?>" target="_blank"><?=$row['name']?></a></span></li>
<? endforeach; ?>
</ul>
</div>
<? endif; ?>
