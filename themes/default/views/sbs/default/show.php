<div class="yui-g">

<h1 class="title"><?=$model->project->title?></h1>
<div class="desc">Создан <?=Date_helper::date_smart($model->date)?></div>

<div class="desc">
Заказчик <?=$model->customer->_online?> 
<font class="frlname11"><a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->name?> <?=$model->customer->surname?></a> [<a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->username?></a>]</font>
</div>

<div class="desc">
</div>

<div class="desc">
Исполнитель <?=$model->performer->_online?> 
<font class="frlname11"><a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->name?> <?=$model->performer->surname?></a> [<a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->username?></a>]</font> 
</div>


<div class="subtitle"></div>

</div>


<div id="yui-main">
<div class="clearfix">

<? if( $model->status == Sbs::STATUS_NEW ): ?>

<div class="alert alert-error">
<strong>Деньги не зарезервированы</strong>
</div>

<? if( $model->customer_id == Yii::app()->user->id ): ?>
              <div class="btn-group">
                <a href="/sbs/reserve?id=<?=$data->id?>" class="btn">Зарезервировать деньги</a>
                <a class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></a>
                <ul class="dropdown-menu" style="list-style:none">
                  <li style="list-style:none"><a href="/sbs/default/close?id=<?=$model->id?>">Отменить</a></li>
                </ul>
              </div><!-- /btn-group -->
<? endif; ?>

<? endif; ?>

<? if( $model->status == Sbs::STATUS_ACTIVE ): ?>

<div class="alert alert-success">
<strong>Деньги зарезервированы</strong>
</div>

<? if( $model->customer_id == Yii::app()->user->id ): ?>
              <div class="btn-group">
                <button class="btn">Завершить сделку</button>
                <button class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></button>
                <ul class="dropdown-menu" style="list-style:none">
                  <li style="list-style:none"><a href="/sbs/arbitration?id=<?=$model->id?>">подать жалобу в арбитраж</a></li>
                </ul>
              </div><!-- /btn-group -->
<? else: ?>
<a href="/sbs/arbitration?id=<?=$model->id?>" class="btn">Подать жалобу в арбитраж</a>
<br />
<br />

<? endif; ?>

<? endif; ?>

<br clear="all" />
 
<h3>Техническое задание</h3>



<div class="content">
<?=$model->project->text?>
</div>


<? if( $model->arbitration ): ?>
<br />
<div class="alert alert-error">
<strong><?=$model->arbitration->userdata->username?> подал жалобу в арбитраж</strong>
<br /><br />
<?=$model->arbitration->text?>
</div>
<? endif; ?>

<?php $this->widget('FlashMessages'); ?>

	<div class="rnd comments-body">
		<div>
			<div>
				<div>
                
<h4>Переписка</h4>


<? foreach($model->letters as $row): ?>
<div class="answer" id="comment<?=$row->id?>">

<div class="com-title">
Добавил <a rel="nofollow" href="/users/<?=$row->userdata->username?>"><?=$row->userdata->username?></a> <?=Date_helper::date_smart($row->date)?>
</div>
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row->userdata->userpic?>" alt="<?=$row->userdata->username?>" class="userpic" />

<div class="com-text">
<?=nl2br($row->text)?>
</div>

</div>
<? endforeach; ?>

				</div>
			</div>
		</div>
	</div>



<?php $form = $this->beginWidget('CActiveForm', array(
'action' => '/sbs/default/AddComment',
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); 
?>

<?php echo CHtml::hiddenField('sbs_id', $model->id);?>

<div class="comments-form">
<h4>Добавить комментарий</h4>

<div>
<?php echo $form->textArea($comment,'text', array('rows' => 7, 'cols' => 60)); ?>
<?php echo $form->error($comment, 'text'); ?>
</div>
<div class="comments-send">


<div class="form-actions">
<button type="submit" class="btn">Добавить</button>
</div>
</div>
</div>
<?php $this->endWidget(); ?>










</div>
</div>