<tr>
<td class="title">

<span class="fr"><strong>Сумма сделки: <?=$data->amount?> рублей</strong></span>

<h3><?=$data->project->title?></h3>

<br />

<? if( $data->status == Sbs::STATUS_COMPLETE): ?>
Сделка завершена
<? endif; ?>

<? if( $data->status == Sbs::STATUS_CLOSE): ?>
Сделка отменена
<? endif; ?>

<? if( $data->status == Sbs::STATUS_DISPUTE): ?>
Подана жалоба в арбитраж
<? endif; ?>

<? if( $data->status == Sbs::STATUS_NEW ): ?>

<div class="alert alert-error">
<strong>Деньги не зарезервированы</strong>
</div>

<? if( $data->customer_id == Yii::app()->user->id ): ?>
              <div class="btn-group">
                <a href="/sbs/reserve?id=<?=$data->id?>" class="btn">Зарезервировать деньги</a>
                <a class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></a>
                <ul class="dropdown-menu" style="list-style:none">
                  <li style="list-style:none"><a href="/sbs/default/close?id=<?=$data->id?>">Отменить</a></li>
                </ul>
              </div><!-- /btn-group -->
<? endif; ?>

<? endif; ?>

<? if( $data->status == Sbs::STATUS_ACTIVE ): ?>

<div class="alert alert-success">
<strong>Деньги зарезервированы</strong>
</div>

<? if( $data->customer_id == Yii::app()->user->id ): ?>
              <div class="btn-group">
                <a href="/sbs/complete?id=<?=$data->id?>" class="btn">Завершить сделку</a>
                <a class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></a>
                <ul class="dropdown-menu" style="list-style:none">
                  <li style="list-style:none"><a href="/sbs/arbitration?id=<?=$data->id?>">подать жалобу в арбитраж</a></li>
                </ul>
              </div><!-- /btn-group -->
<? endif; ?>

<? endif; ?>


<div>

<br />

Заказчик <?=$data->customer->_online?> 
<font class="frlname11"><a href="/users/<?=$data->customer->username?>" class="frlname11"><?=$data->customer->name?> <?=$data->customer->surname?></a> [<a href="/users/<?=$data->customer->username?>" class="frlname11"><?=$data->customer->username?></a>]</font>
 | 
Исполнитель <?=$data->performer->_online?> 
<font class="frlname11"><a href="/users/<?=$data->performer->username?>" class="frlname11"><?=$data->performer->name?> <?=$data->performer->surname?></a> [<a href="/users/<?=$data->performer->username?>" class="frlname11"><?=$data->performer->username?></a>]</font> 
   

</div>


<br />

<p>
<a href="/sbs/default/show/?id=<?=$data->id?>" class="btn">Подробнее</a>

</p>       

</tr>