<div class="user" id="user_<?=$data->favoritedata->id?>">

<div class="name"><a href="/users/<?=$data->favoritedata->username?>" rel="follows"><?=$data->favoritedata->username?></a></div>

<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->favoritedata->userpic?>" alt="" width="60px"/>

<div class="panel"><a href="#" onclick="favorites.remove(<?=$data->favoritedata->id?>, this); return false;"><span class="label label-info"><i class="icon-remove icon-white"></i></span></a></div>

</div>