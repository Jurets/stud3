<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div id="order-page" class="yui-b clearfix">

<?php $this->widget('FlashMessages'); ?>

<table class="project">
<tr>
<td class="lbl btb">Покупатель(Плательщик):</td>
<td class="txt">
      <ul class="ocard">
      	<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->userdata->userpic?>" class="avatar" width="60" />
        <li class="black">
<?=$data->userdata->_tariff?> 
<?=$data->userdata->_online?> 
<font class="frlname11"><a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->name?> <?=$model->userdata->surname?></a> [<a href="/users/<?=$data->userdata->username?>" class="frlname11"><?=$data->userdata->username?></a>]</font>    
        </li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$model->userdata->username?>/?review=negative"><?=$data->userdata->static->reviews_positive?></a>
<? if( $model->userdata->static->reviews_negative ): ?>
<a class="rev-negative" href="/users/reviews/<?=$model->userdata->username?>/?review=negative"><?=$data->userdata->static->reviews_negative?></a>
<? endif; ?>
</li>
<li><a href="/contacts/send/<?=$data->userdata->username?>">Личное сообщение</a></li>
      </ul>
</td>
</tr>

<tr>
<td class="lbl btb">Продавец(Получатель):</td>
<td class="txt">
      <ul class="ocard">
      	<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->recipient->userpic?>" class="avatar" width="60" />
        <li class="black">
<?=$data->recipient->_tariff?> 
<?=$data->recipient->_online?> 
<font class="frlname11"><a href="/users/<?=$data->recipient->username?>" class="frlname11"><?=$data->recipient->name?> <?=$model->recipient->surname?></a> [<a href="/users/<?=$data->recipient->username?>" class="frlname11"><?=$data->recipient->username?></a>]</font>    
        </li>
<li>
Отзывы 
<a class="rev-positive" href="/users/reviews/<?=$model->recipient->username?>/?review=negative"><?=$data->recipient->static->reviews_positive?></a>
<? if( $model->recipient->static->reviews_negative ): ?>
<a class="rev-negative" href="/users/reviews/<?=$model->recipient->username?>/?review=negative"><?=$data->recipient->static->reviews_negative?></a>
<? endif; ?>
</li>
<li><a href="/contacts/send/<?=$data->recipient->username?>">Личное сообщение</a></li>
      </ul>
</td>
</tr>

<tr>
<td class="lbl">Сумма:</td>
<td class="txt"><strong><?=$data->amount?> рублей</strong></td>
</tr>

<tr>
<td class="lbl">Продукт:</td>
<td class="txt"><?=$data->item_id?></td>
</tr>

<tr>
<td class="lbl">Создан:</td>
<td class="txt"><?=Date_helper::date_smart($data->date)?></td>
</tr>

<tr>
<td class="lbl">Статус:</td>
<td class="txt"><?=$data->getStatus()?></td>
</tr>

</table>

<? if( $data->status == Payments::STATUS_ACTIVE ): ?>
<div class="alert alert-block alert-info">

<h4 class="alert-heading">Сделка ожидает завершения</h4>

<? if( $data->recipient_id == Yii::app()->user->id ): // если получатель ?>
<p>Если получатель не имеет возможности предоставить товар, то продавец обязан вернуть платеж</p>
<p>
<a href="/account/payments/<?=$data->id?>.html?action=cancel" onclick="return confirm('Вернуть платеж?')" class="btn btn-primary">Возвратить</a>
<a href="#" onclick="return confirm('Подать жалобу в арбитраж?')" class="btn">Подать жалобу в арбитраж</a></p>
<? endif; ?>

<? if( $data->user_id == Yii::app()->user->id ): // если покупатель ?>
<p>После получения товара, покупатель обязан завершить сделку</p>
<p>
<a href="/account/payments/<?=$data->id?>.html?action=apply" onclick="return confirm('Подтвердить получение товара?')" class="btn btn-primary">Подтвердить</a>
<a href="#" onclick="return confirm('Подать жалобу в арбитраж?')" class="btn">Подать жалобу в арбитраж</a>
</p>
<? endif; ?>

</div>
<? endif; ?>

</div>
<!--/order-page-->
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>
