<h3 class="title"><?=$model->project->title?></h3>
<?php $this->widget('FlashMessages'); ?>

<?php $this->renderPartial('//tenders/default/_tender', array('model'=>$model->project)); ?>
                    
<div class="yui-g">

    <div class="alert alert-block">
        <h4>Сведения о сделке</h4>
        <div class="desc">Создан <?=Date_helper::date_smart($model->date)?></div>
        <p>сумма сделки (рублей): <?=$model->amount?></p>
        <p>период (дней): <?=$model->period?></p>
        <? // ---------------- Кнопки управления ответом исполнителя на заказ ---------- ?>
        <? if (Yii::app()->user->id == $model->customer->id) { ?>
            <div class="desc">
                Заказчик <?=$model->customer->_online?> 
                <font class="frlname11"><a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->name?> <?=$model->customer->surname?></a> [<a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->username?></a>]</font>
            </div>

            <div class="desc"></div>
            
            <div class="desc">
                Исполнитель <?=$model->performer->_online?> 
                <font class="frlname11"><a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->name?> <?=$model->performer->surname?></a> [<a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->username?></a>]</font> 
            </div>
            <? if ($model->status == Sbs::STATUS_REJECT) { ?>
                <div class="alert alert-error">
                    <strong>Исполнитель отказался</strong> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/publication/'.$model->project->id)?>">Выберите другого исполнителя</a>
                </div>
                

            <? } ?>
            
        <? } else if (Yii::app()->user->id == $model->performer->id) { ?>

            <? if ($model->status == Sbs::STATUS_NEW) { ?>
                <p>
                    <i class="icon-pencil"></i> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/confirm', array('id'=>$model->id))?>">Принять предложение</a> 
                    <i class="icon-remove"></i> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/reject', array('id'=>$model->id))?>" class="red">Отказаться</a>
                </p>
            <? } else if ($model->status == Sbs::STATUS_WAITRESERV) {?>
                <p>Ожидание пополнения денег заказчиком</p>
            <? }  else if ($model->status == Sbs::STATUS_REJECT) {?>
                <p>Вы отказались от выполнения проекта</p>
            <? } ?>
        <? } ?>
    </div>
    
    
    <div class="subtitle"></div>

</div>


<div id="yui-main">
    <div class="clearfix">

        <? if( $model->status == Sbs::STATUS_NEW || $model->status == Sbs::STATUS_WAITRESERV): ?>

            <div class="alert alert-error">
                <strong>Деньги не зарезервированы</strong>
            </div>

            <? if( $model->customer_id == Yii::app()->user->id ): ?>
                <div class="btn-group">
                    <!--<a href="/sbs/reserve?id=<?=$model->id?>" class="btn">Зарезервировать деньги</a>-->
                    <a href="<?=Yii::app()->createAbsoluteUrl('/sbs/reserve/' . $model->id)?>" class="btn">Зарезервировать деньги</a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="list-style:none">
                        <li style="list-style:none"><a href="/sbs/default/close?id=<?=$model->id?>">Отменить</a></li>
                    </ul>
                </div><!-- /btn-group -->
                <? endif; ?>

            <? endif; ?>

        <? if( $model->status == Sbs::STATUS_ACTIVE ) { ?>

            <div class="alert alert-success">
                <strong>Деньги зарезервированы</strong>
            </div>

            <? if( $model->customer_id == Yii::app()->user->id ) { ?>
                <div class="btn-group">
                    <button class="btn">Завершить сделку</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="list-style:none">
                        <li style="list-style:none"><a href="/sbs/arbitration?id=<?=$model->id?>">подать жалобу в арбитраж</a></li>
                    </ul>
                </div><!-- /btn-group -->
                <? } else { ?>
                    <? if ($model->status == Sbs::STATUS_ACTIVE) { ?>
                        <a href="<?=Yii::app()->createAbsoluteUrl('sbs/done/' . $model->id)?>" class="btn">Сдать работу</a>
                        <br />
                    <? } ?>
                    <a href="/sbs/arbitration?id=<?=$model->id?>" class="btn">Подать жалобу в арбитраж</a>
                    <br />
                <? } ?>

            <? } ?>

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
