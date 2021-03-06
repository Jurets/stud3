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

    <div class="alert alert-block">
        <h4>Сведения о сделке</h4>
        <div class="desc">Создан <?=Date_helper::date_smart($model->date)?></div>
        <p>сумма сделки (рублей): <?=$model->amount?></p>
        <p>период (дней): <?=$model->period?></p>
        <p>дата сдачи: <?=date('d.m.Y', $model->dateEnd)?></p>
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
            
        <? } else if ($is_performer) { ?>
            <? if ($model->status == Sbs::STATUS_NEW) { ?>
                <p>
                    <i class="icon-pencil"></i> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/confirm', array('id'=>$model->id))?>">Принять предложение</a> 
                    <i class="icon-remove"></i> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/reject', array('id'=>$model->id))?>" class="red">Отказаться</a>
                </p>
            <? } ?>
        <? } ?>
    </div>
    
    
<!-- ----------------- Статус сделки ------------------ -->
    <? if ($model->status == Sbs::STATUS_NEW) { ?>
        <div class="alert alert-block">
            <strong>Ждёт подтверждения исполнителем</strong>
        </div>
    <? } else if ($model->status == Sbs::STATUS_REJECT) { ?>
        <div class="alert alert-block">
            <? if ($is_customer) { ?>
                <strong>Исполнитель отказался</strong> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/publication/'.$model->project->id)?>">Выберите другого исполнителя</a>
            <? } else if ($is_performer) { ?>
                <strong>Вы отказались от выполнения проекта</strong>
            <? } ?>
        </div>
    <? } else if ($model->status == Sbs::STATUS_WAITRESERV) { ?>
        <? if ($is_customer) { ?>
            <div class="alert alert-error">
                <strong>Деньги не зарезервированы</strong>
            </div>
        <? } else if ($is_performer) { ?>
            <div class="alert alert-block">
                <strong>Ожидание пополнения денег заказчиком</strong>
            </div>
        <? } ?>
    <? } else if ($model->status == Sbs::STATUS_ACTIVE) { ?>
        <div class="alert alert-success">
            <? if ($is_customer) { ?>
                <strong>Деньги зарезервированы. Исполнитель приступил к выполению заказа</strong>
            <? } else if ($is_performer) { ?>
                <strong>Деньги зарезервированы. Можете приступать к выполению заказа</strong>
            <? } ?>
        </div>
    <? } else if ($model->status == Sbs::STATUS_DONE || $model->status == Sbs::STATUS_DISPUTE) { ?>
        <div class="alert alert-success">
            <strong>Исполнитель сдал работу</strong>
        </div>
    <? } else if ($model->status == Sbs::STATUS_DELAY) { ?>
        <div class="alert alert-error">
            <strong>Заказ просрочен</strong>
        </div>
    <? } else if ($model->status == Sbs::STATUS_COMPLETE) { ?>
        <div class="alert alert-success">
            <strong>Сделка завершена</strong>
        </div>
    <? } ?>
    
    <!-- Дней до окончания 20-дневного срока после сдачи работы -->
    <? if ($model->status == Sbs::STATUS_DONE || $model->status == Sbs::STATUS_DISPUTE) { ?>
        <div class="alert alert-block">
            <p>Осталось дней до завершения: <?=$model->daysEtaComplete()?></p>
        </div>
    <? } ?>
    
    <br />
    
    <!-- ----------------- Арбитраж ------------------ -->
    <? if ($model->arbitration) { ?>
        <div class="alert alert-error">
            <strong><?=$model->arbitration->userdata->username?> подал жалобу в арбитраж</strong>
            <br /><br />
            <?=$model->arbitration->text?>
        </div>
    <? } ?>
    
    <div class="subtitle"></div>

</div>


<div id="yui-main">
    <div class="clearfix">

    <!-- ----------------- Переписка ------------------ -->

        <h4>Переписка</h4>
        <?php 
        // отобразить переписку по заказу (если есть) - то, что было до заключения сделки
            if (isset($model->project) && isset($model->project->winner) && $model->project->winner->LettersCount) { 
                 foreach($model->project->winner->letters as $letter)  { //пройтись по письмам 
                    $this->renderPartial('../../tenders/default/_bidletter', array('letter'=>$letter));
                 } 
            }            
        ?>

        <div class="rnd comments-body">
            <div>
                <div>
                    <div>
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

        <? if ($model->status != Sbs::STATUS_COMPLETE && !$model->arbitration) { ?>
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
        <?php } ?>

    <!-- ----------------- Управление сделкой ------------------ -->
        <? if ($model->status == Sbs::STATUS_NEW || $model->status == Sbs::STATUS_WAITRESERV) { ?>

            <? if ($is_customer) { ?>
                <div class="btn-group">
                    <a href="<?=Yii::app()->createAbsoluteUrl('/sbs/reserve/' . $model->id)?>" class="btn">Зарезервировать деньги</a>
                    <!--<a class="btn dropdown-toggle" data-toggle="dropdown">или <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="list-style:none">
                        <li style="list-style:none"><a href="/sbs/default/close?id=<?=$model->id?>">Отменить</a></li>
                    </ul>-->
                </div><!-- /btn-group -->
                <? } ?>

        <? } else if( $model->status == Sbs::STATUS_ACTIVE || $model->status == Sbs::STATUS_DONE || $model->status == Sbs::STATUS_DISPUTE || $model->status == Sbs::STATUS_COMPLETE || $model->status == Sbs::STATUS_DELAY) { ?>

    <!-- ----------------- Выполнение работы ------------------ -->
            
            <? //выставить флаг - показывать ли форму отсылки работы
            //showSendForm = ($is_performer && $model->status == Sbs::STATUS_ACTIVE) || ($is_customer && $model->status == Sbs::STATUS_DONE && $model->isDeliver());
            $showSendForm = ($model->status == Sbs::STATUS_ACTIVE || $model->status == Sbs::STATUS_DONE);
            $ifWorksExists = isset($model->works) && count($model->works);
            if ($showSendForm || $ifWorksExists) {?>
                <h4>Выполнение работы</h4>
            <? } ?>

            <? if ($ifWorksExists) { ?>
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
            
            <h4>Сдать работу</h4>
            <? //выставить флаг - показывать ли форму отсылки работы
            //showSendForm = ($is_performer && $model->status == Sbs::STATUS_ACTIVE) || ($is_customer && $model->status == Sbs::STATUS_DONE && $model->isDeliver());
            //$showSendForm = ($model->status == Sbs::STATUS_ACTIVE || $model->status == Sbs::STATUS_DONE);
            if ($showSendForm) { 
                if ($is_performer && $model->status == Sbs::STATUS_ACTIVE && !$model->isDeliver()) {
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
                <a href="<?=Yii::app()->createAbsoluteUrl('/sbs/arbitration/' . $model->id)?>" class="btn">Подать жалобу в арбитраж</a>
                <? if ($is_customer) { ?>
                    <a href="<?=Yii::app()->createAbsoluteUrl('/sbs/complete/' . $model->id)?>" class="btn">Завершить сделку</a>
                <? } ?>
            <? } ?>
            
            <? if ($model->status == Sbs::STATUS_DELAY && $is_customer) { ?>
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'prolongation', 
                    'action' => 'prolongation/'.$model->id,
                    'enableClientValidation'=>false,
                    'errorMessageCssClass'=>'alert alert-error',
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                        'validateOnChange'=>true,
                        'validateOnType' => false,
                    ),
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                )); ?>
                    <?php //echo $form->errorSummary($bid); ?>
                    <p><b class="btn"><strong>Срок</strong></b></p>
                        <?php echo CHtml::textField('Sbs[period]', date('d.m.Y'), array(
                            'class' => 'inp_text datepicker'/*, 'size' => 3*/   
                            )); ?>
                    <?php //echo $form->error($bid,'text'); ?>
                    <input type="submit" class="inp_sub" value="Продлить" />
                <?php $this->endWidget(); ?>
                <a href="<?=Yii::app()->createAbsoluteUrl('/sbs/close/' . $model->id)?>" class="btn">Отказаться от заказа</a>
            <? } ?>
        <? } ?>

        <br clear="all" />

    </div>
</div>
