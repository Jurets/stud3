<div class="yui-g">

<h1 class="title"><?=$model->project->title?></h1>
<div class="desc">Создан <?=Date_helper::date_smart($model->date)?></div>

<div class="desc">
Заказчик <?=$model->customer->_online?> 
<font class="frlname11"><a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->name?> <?=$model->customer->surname?></a> [<a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->username?></a>]</font>
</div>

<div class="desc">
Исполнитель <?=$model->performer->_online?> 
<font class="frlname11"><a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->name?> <?=$model->performer->surname?></a> [<a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->username?></a>]</font> 
</div>


<div class="subtitle"></div>

</div>


<div id="yui-main">
<div class="clearfix">

<?php $this->widget('FlashMessages'); ?>

<? if( $balance == TRUE ): ?>

<?php $form = $this->beginWidget('CActiveForm'); ?>

<?php echo CHtml::hiddenField('reserve', TRUE);?>

<button type="submit" class="btn">Зарезервировать деньги</button>

<?php $this->endWidget(); ?>

<? else: ?>
<a href="/account/balance/" class="btn">Пополнить баланс</a>
<? endif; ?>

</div>
</div>