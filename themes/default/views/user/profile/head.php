<ul class="nav nav-tabs">
<li<? if( Yii::app()->controller->action->id == 'index' ): ?> class="active"<? endif; ?>><a href="/users/<?=$data->username?>">Профиль</a></li>
<li<? if( Yii::app()->controller->action->id == 'contacts' ): ?> class="active"<? endif; ?>><a href="/users/contacts/<?=$data->username?>">Контакты<span class="tab-moreover"><?=$data->static->friends?></span></a></li>
<li<? if( Yii::app()->controller->action->id == 'items' ): ?> class="active"<? endif; ?>><a href="/users/items/<?=$data->username?>">Товары<span class="tab-moreover"><?=$data->static->items?></span></a></li>
<li<? if( Yii::app()->controller->action->id == 'blog' ): ?> class="active"<? endif; ?>><a href="/users/blog/<?=$data->username?>">Блог<span class="tab-moreover"><?=$data->static->blogs?></span></a></li>
<li<? if( Yii::app()->controller->action->id == 'favorites' ): ?> class="active"<? endif; ?>><a href="/users/favorites/<?=$data->username?>">Подписчики<span class="tab-moreover"><?=$data->static->favorites?></span></a></li>
<li<? if( Yii::app()->controller->action->id == 'portfolio' ): ?> class="active"<? endif; ?>><a href="/users/portfolio/<?=$data->username?>">Портфолио<span class="tab-moreover"><?=$data->static->portfolio?></span></a></li>
<li<? if( Yii::app()->controller->action->id == 'reviews' ): ?> class="active"<? endif; ?>><a href="/users/reviews/<?=$data->username?>">Отзывы<span class="tab-moreover"><?=$data->static->reviews_positive?></span></a></li>        
</ul>

<div class="yui-g usertitle">
<h1><?=$data->_tariff?> <?=$data->name?> <?=$data->surname?>  [<?=$data->username?>]</h1>
<p class="desc"><?=$data->_online?>

<? if( $data->online == User::ONLINE ): ?>
НА САЙТЕ
<? else: ?>
Последний визит: <?=Date_helper::date_smart($data->last_login)?>
<? endif; ?>
</p>
</div>