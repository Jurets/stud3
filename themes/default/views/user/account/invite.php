<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<table class="contractors">
<tr>
<td class="text"><a href="/users/<?=$invite->senderdata->username?>"> <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$invite->senderdata->userpic?>" class="avatar" width="70" /></a>
<ul class="ucard">
<li class="black">
<a href="/account/tariff" class="ac-pro"><img src="/images/f-pro.png" alt="PRO"  /></a> <img src="/images/dot_active.png" class="u-inact" alt="На сайте" title="На сайте" /> 
<font class="frlname11"><a href="/users/<?=$invite->senderdata->username?>" class="frlname11"><?=$invite->senderdata->name?> <?=$invite->senderdata->surname?></a> [<a href="/users/<?=$invite->senderdata->username?>" class="frlname11"><?=$invite->senderdata->username?></a>]</font>
</li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$invite->senderdata->username?>/?review=positive">0</a>
</li>
<li><a href="/contacts/send/<?=$invite->senderdata->username?>">Личное сообщение</a></li>
</ul>
<br clear="all" /><br clear="all" />

</td>
</tr>
</table>

<p>
<br />
<?=nl2br($invite->text)?>
<br />
</p>

<div class="form-actions">
<a href="/user/account/invite?id=<?=$invite->id?>&action=accept" class="btn">Принять</a> 
<a href="/user/account/invite?id=<?=$invite->id?>&action=reject" class="btn">Отклонить</a>
</div>


</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>