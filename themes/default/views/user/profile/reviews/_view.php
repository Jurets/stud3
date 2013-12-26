<tr>
<td class="review-card"><img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userdata->userpic?>" alt="" class="avatar" width="60" />
<ul class="rcard">
<li class="utitle">
<?=$data->userdata->_tariff?> 
<?=$data->userdata->_online?> 
<font class="frlname11"><a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->name?> <?=$data->userdata->surname?></a> [<a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->username?></a>]</font>
</li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$data->userdata->username?>/?review=negative"><?=$data->userdata->static->reviews_positive?></a>
<? if( $data->userdata->static->reviews_negative ): ?>
<a class="rev-negative" href="/users/reviews/<?=$data->userdata->username?>/?review=negative"><?=$data->userdata->static->reviews_negative?></a>
<? endif; ?>
</li>
<li><a href="/contacts/send/<?=$data->userdata->username?>">Личное сообщение</a></li>
</ul>
</td>
<td class="txtc review-mark"><?=$data->mark?></td>
</tr>

<tr>
<td colspan="3" class="review-text">
<p><?=nl2br($data->text)?></p>
<span class="review-date">Размещено: <?=Date_helper::date_smart($data->date)?></span></td>
</tr>
<tr>
<td colspan="3" class="sep txtr">&nbsp;</td>
</tr>