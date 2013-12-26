<div id="sidebar" class="yui-b">
<div id="usercard" class="profile clearfix">
<div class="clearfix">

<? if( $data->id == Yii::app()->user->id ): ?>
<a href="#" onclick="crop.open()"><img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userpic_f?>" /></a>
<? else: ?>
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userpic_f?>" />
<? endif; ?>

<div class="sendpm">
</div>

<? if( !Yii::app()->user->isAuthenticated() ): ?>
<div class="alert alert-info">
<a class="close" data-dismiss="alert">&times;</a>
<a href="/login">Авторизируйтесь</a> или <a href="/registration">зарегистрируйтесь</a>, чтобы связаться с пользователем.
</div>
<? endif; ?>

<? if( $data->id == Yii::app()->user->id ): ?>
<ul class="nav nav-list">

<li class="nav-header">Фотография</li>
<li><a href="/account/userpic"><i class="icon-picture"></i> Загрузить новую фотографию</a></li>
<li><a href="#" onclick="crop.open()"><i class="icon-pencil"></i> Изменить миниатюру</a></li>
<li><a href="/user/account/deleteuserpic" onclick="crop.open()"><i class="icon-remove"></i> Удалить</a></li>
</ul>
<? elseif( Yii::app()->user->isAuthenticated() ): ?>
<ul class="nav nav-list">



<? if( !$this->checkInvite && !$this->checkFriend ): // если нету приглашения и нету в друзьях ?>
<li><a href="/users/invite/<?=$data->username?>"><i class="icon-plus"></i> <strong>Добавить в контакты</strong></a></li>
<? else: ?>

<? if( $this->checkInvite ): ?>
<li class="grey">Приглашение уже отправлено, ожидайте пока <?=$data->name?> подтвердит Ваше приглашение</li>
<li>&nbsp;</li>
<? endif; ?>

<? if( $this->checkFriend ): ?>
<li><strong><?=$data->name?> у Вас в контактах</strong></li>
<li>&nbsp;</li>
<? endif; ?>

<? endif; ?>




<li><a href="/contacts/send/<?=$data->username?>"><i class="icon-envelope"></i> Написать сообщение</a></li>

<? if( UsersFavorites::Check($data->id) ): // если предложение отправлено ?>
<li><a href="#" onclick="favorites.add(<?=$data->id?>, this); return false;"><i class="icon-star"></i> Удалить из избранного</a></li>
<? else: ?>
<li><a href="#" onclick="favorites.add(<?=$data->id?>, this); return false;"><i class="icon-star"></i> Добавить в избранное</a></li>
<? endif; ?>
</ul>
<? endif; ?>



</div>

<div class="sendpm">
</div>

<table class="userstats">

<tr>
<td>Регистрация</td>
<td><?=Date_helper::date_smart($data->created)?></td>
</tr>

<tr>
<td>Последний визит</td>
<td><?=Date_helper::date_smart($data->last_activity)?></td>
</tr>

<tr>
<td>Пол</td>
<td><?=$data->getGender()?></td>
</tr>



<? if( $data->age() ): ?>
<tr>
<td>Возраст</td>
<td><?=$data->age()?></td>
</tr>
<tr>
<? endif; ?>

<tr>
<td>Отзывы</td>
<td>
<a class="rev-positive" href="/users/reviews/<?=$data->username?>/?review=positive"><?=$data->static->reviews_positive?></a>
<a class="rev-negative" href="/users/reviews/<?=$data->username?>/?review=negative"><?=$data->static->reviews_negative?></a>
</td>
</tr>

<tr>
<td>Просмотров</td>
<td><?=$data->views?></td>
</tr>
<!--
<? if( $data->tags->toString() ): ?>
<tr>
<td colspan="2">
<strong>Навыки:</strong>
<br />
<?=$data->tags->toString();?>
</td>
</tr>
<? endif; ?>
-->
<tr>
<td colspan="2" class="noborder blue" align="center">
<strong>рейтинг <?=$data->rating?></strong>
</td>
</tr>

</table>




</div>
</div>