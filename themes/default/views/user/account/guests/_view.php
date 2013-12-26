<div class="user" id="user_<?=$data->guestdata->id?>">

<div class="name"><a href="/users/<?=$data->guestdata->username?>" rel="follows"><?=$data->guestdata->username?></a></div>

<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->guestdata->userpic?>" alt="" width="60px"/>

<div class="panel"><?=Date_helper::date_smart($data->update)?></div>

</div>