<?php 
    //инициализация параметров
    $isLoggedUser = !Yii::app()->user->isGuest;  //текущий юзер - не гость
    if ($isLoggedUser) {
        $user = User::model()->findByPk(Yii::app()->user->id);  //найти текущего юзера
        $is_customer  = (Yii::app()->user->id == $model->customer->id);   //признак юзер=заказчик
        $is_performer = (Yii::app()->user->id == $model->performer->id);  //признак юзер=исполнитель
        //$is_owner = (Yii::app()->user->id == $model->user_id);  //признак, что это хозяин заказа
    } else {
        $user = null;  
        $is_performer = false;
        $is_customer  = false;
    }
?>


<h3 class="title"><?=$model->project->title?></h3>
<?php $this->widget('FlashMessages'); ?>

<?php $this->renderPartial('//tenders/default/_tender', array('model'=>$model->project)); ?>
                    
<div class="yui-g">

        <!--<h3>Техническое задание</h3>
        <div class="content">
            <?=$model->project->text?>
        </div> -->

    <div class="alert alert-block">
        <h4>Сведения о сделке</h4>
        <div class="desc">Создан <?=Date_helper::date_smart($model->date)?></div>
        <p>сумма сделки (рублей): <?=$model->amount?></p>
        <p>период (дней): <?=$model->period?></p>
        <? // ---------------- Кнопки управления ответом исполнителя на заказ ---------- ?>
        <? if ($is_customer) { ?>
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
            
        <? } else if ($is_performer) { ?>

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

    <!-- ----------------- Переписка ------------------ -->
        <div class="rnd comments-body">
            <div>
                <div>
                    <div>
                        <h4>Переписка</h4>
                        <? foreach($model->letters as $row) { ?>
                            <div class="answer" id="comment<?=$row->id?>">
                                <div class="com-title">
                                    Добавил <a rel="nofollow" href="/users/<?=$row->userdata->username?>"><?=$row->userdata->username?></a> <?=Date_helper::date_smart($row->date)?>
                                </div>
                                <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row->userdata->userpic?>" alt="<?=$row->userdata->username?>" class="userpic" />
                                <div class="com-text">
                                    <?=nl2br($row->text)?>
                                </div>
                            </div>
                        <? } ?>
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
                <?php echo $form->textArea($comment,'text', array('class' => 'area', 'rows' => '4', 'cols' => '58', 'style' => 'width: 758px;')); ?>
                <?php echo $form->error($comment, 'text'); ?>
            </div>
            <div class="comments-send">
                <div class="form-actions">
                    <button type="submit" class="btn">Добавить</button>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>

    <!-- ----------------- Управление сделкой ------------------ -->
        <? if( $model->status == Sbs::STATUS_NEW || $model->status == Sbs::STATUS_WAITRESERV) { ?>

            <div class="alert alert-error">
                <strong>Деньги не зарезервированы</strong>
            </div>

            <? if ($is_customer) { ?>
                <div class="btn-group">
                    <!--<a href="/sbs/reserve?id=<?=$model->id?>" class="btn">Зарезервировать деньги</a>-->
                    <a href="<?=Yii::app()->createAbsoluteUrl('/sbs/reserve/' . $model->id)?>" class="btn">Зарезервировать деньги</a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="list-style:none">
                        <li style="list-style:none"><a href="/sbs/default/close?id=<?=$model->id?>">Отменить</a></li>
                    </ul>
                </div><!-- /btn-group -->
                <? } ?>

        <? } else if( $model->status == Sbs::STATUS_ACTIVE || $model->status == Sbs::STATUS_DONE) { ?>

            <div class="alert alert-success">
                <? if( $model->status == Sbs::STATUS_ACTIVE) { ?>
                    <strong>Деньги зарезервированы</strong>
                <? } else if( $model->status == Sbs::STATUS_DONE) { ?>
                    <strong>Исполнитель сдал работу</strong>
                <? } ?>
            </div>

    <!-- ----------------- Выполнение работы ------------------ -->
            
            <? if (isset($model->works) && count($model->works)) { ?>
                <h4>Выполнение работы</h4>
                <? foreach($model->works as $sbswork) { ?>
                    <div class="answer" id="sbswork<?=$sbswork->id?>">
                        <div class="com-title">
                            Добавил <a rel="nofollow" href="/users/<?=$sbswork->userdata->username?>"><?=$sbswork->userdata->username?></a> 
                            <?=Date_helper::date_smart($sbswork->date)?> 
                            <?=$sbswork->typeStr?>
                        </div>
                        <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$sbswork->userdata->userpic?>" alt="<?=$sbswork->userdata->username?>" class="userpic" />
                        <div class="com-text">
                            <?=nl2br($sbswork->text)?>
                        </div>
                        <div>Файлы: 
                            <? if (isset($sbswork->files) && count($sbswork->files)) {
                                $path = Yii::app()->getModule('sbs')->workAttachmentsDir;
                                $files = array();
                                foreach($sbswork->files as $index=>$file) 
                                    $files[] = CHtml::link($file->origname, Yii::app()->createAbsoluteUrl($path . $file->filename));
                                echo implode(', ', $files);
                            } ?>
                        </div>
                    </div>
                <? } ?>
            <? } ?>
            
            <? //выстваить флаг - показывать ли форму отсылки работы
            //showSendForm = ($is_performer && $model->status == Sbs::STATUS_ACTIVE) || ($is_customer && $model->status == Sbs::STATUS_DONE && $model->isDeliver());
            $showSendForm = ($model->status == Sbs::STATUS_ACTIVE || $model->status == Sbs::STATUS_DONE);
            if ($showSendForm) { 
                if ($is_performer && $model->status == Sbs::STATUS_ACTIVE) {
                    $type = SbsWork::TYPE_DELIVER;
                    $action = '/sbs/done/';
                    $label = 'Сдать работу';
                } else if ($is_customer){
                    $type = SbsWork::TYPE_DEMAND;
                    $action = '/sbs/sendwork/';
                    $label = 'Внести правки';
                } else {
                    $type = SbsWork::TYPE_REWORK;
                    $action = '/sbs/sendwork/';
                    $label = 'Выслать правки';
                }
                                        
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'work', 
                    'action' => $action . $model->id,
                    'enableClientValidation'=>false,
                    'errorMessageCssClass'=>'alert alert-error',
                    'clientOptions'=>array(
                        'validateOnSubmit'=>false,
                        'validateOnChange'=>false,
                        'validateOnType' => false,
                    ),
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                )); 
                    echo CHtml::hiddenField('sbs_id', $model->id);
                    echo $form->errorSummary($work); ?>
                    
                    <p><b class="btn"><strong>Введите сообщение</strong></b></p>
                    <?php echo $form->textArea($work, 'text', array('class' => 'area', 'rows' => '4', 'cols' => '58', 'style' => 'width: 758px;')); ?>
                    <?php $this->widget('CMultiFileUpload', array(
                            'name' => 'attachments',
                            'max' => SbsWorkFile::MAX,
                            'accept' => 'zip|rar|arj|7z|arc|tar|gz|pdf|doc|docx|xls|xlsx|txt|ppt',
                            'duplicate' => 'Duplicate file!',
                            'denied' => 'Неверный тип файла',
                            //'htmlOptions' => array('disabled'=> ($work->getMax() > 0) ? FALSE : TRUE ),
                        ));     
                    ?>

                    <? echo CHtml::hiddenField('type', $type);   //скрытое поле - тип пересылаемой работы ?>                    
                    <input type="submit" class="inp_sub" name="sbs_done" value="<?=$label?>" />
                    
                <?php $this->endWidget(); ?>

                <!--<a href="<?=Yii::app()->createAbsoluteUrl('sbs/done/' . $model->id)?>" class="btn">Сдать работу</a>-->

                <br />
            <? } ?>
            
            <? if ($model->status == Sbs::STATUS_DONE) { ?>
                <a href="/sbs/arbitration?id=<?=$model->id?>" class="btn">Подать жалобу в арбитраж</a>
            <? } ?>
            <? if ($is_customer) { ?>
                <a href="/sbs/complete?id=<?=$model->id?>" class="btn">Завершить сделку</a>
            <? } ?>
            
            <? /*if ($is_customer) { ?>
                <div class="btn-group">
                    <button class="btn">Завершить сделку</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="list-style:none">
                        <li style="list-style:none"><a href="/sbs/arbitration?id=<?=$model->id?>">подать жалобу в арбитраж</a></li>
                    </ul>
                </div><!-- /btn-group -->
            <? } else { ?>
                
                <br>
                <a href="/sbs/arbitration?id=<?=$model->id?>" class="btn">Подать жалобу в арбитраж</a>
                
                <br />
            <? }*/ ?>

            <? if( $model->arbitration ): ?>
                <br />
                <div class="alert alert-error">
                    <strong><?=$model->arbitration->userdata->username?> подал жалобу в арбитраж</strong>
                    <br /><br />
                    <?=$model->arbitration->text?>
                </div>
            <? endif; ?>
            
        <? } ?>

        <br clear="all" />

    </div>
</div>
