<?php //DebugBreak();
    //инициализация параметров
    $userBid = $model->checkBid();     //есть ли заявка от текущего юзера (если он исполнитель) (вернёт ИД)
    $acceptBid = $model->checkABid();  //есть ли принятая заявка

    $isLoggedUser = !Yii::app()->user->isGuest;  //текущий юзер - не гость
    if ($isLoggedUser) {
        $user = User::model()->findByPk(Yii::app()->user->id);  //найти текущего юзера
        $is_customer = ($user->usertype == User::USERTYPE_CUSTOMER);    //признак юзер=заказчик
        $is_performer = ($user->usertype == User::USERTYPE_PERFORMER);  //признак юзер=исполнитель
        $is_owner = (Yii::app()->user->id == $model->user_id);  //признак, что это хозяин заказа
    } else {
        $user = null;  
        $is_performer = false;
    }
?>

<div class="container">
    <div class="row">
        <div data-motopress-wrapper-type="content" data-motopress-wrapper-file="page-testi.php" class="span12">
            <div class="row">
                <div data-motopress-static-file="static/static-title.php" data-motopress-type="static" class="span12">
                    <section class="title-section">
                        <h1 class="title-header">
                            Страница заказа    </h1>
                        <!-- BEGIN BREADCRUMBS-->
                        <ul class="breadcrumb breadcrumb__t"><li><a href="<?=Yii::app()->createAbsoluteUrl('tenders')?>">Лента заказов</a></li><li class="divider"></li><li><?=$model->title?></li> 
                        </ul></section><!-- .title-section -->
                </div>
            </div>
            <div class="row">
                <div data-motopress-loop-file="loop/loop-testi.php" data-motopress-type="loop" id="content" class="span8 right">
                    <? //вывести сведения о заказе (он в отдельной частной вьюшке) ?>
                    <?php $this->renderPartial('//tenders/default/_tender', array('model'=>$model)); ?>
                    
                    <? //неавторизированные пользователи и заказчики видят вместо формы надпись ?>
                    <? if (!$isLoggedUser || ($is_customer && !$is_owner)) {?>
                        <div class="alert alert-block">
                            <h4>Чтобы ответить на заказ необходимо зарегистрироваться как исполнитель</h4>
                        </div>
                    <? } ?>
                    
                    <? //------------- Проверить наличие исполнителя -------------?>
                    <? if (isset($model->sbs)) {?>
                        <br />
                        <div class="alert alert-block">
                            <h4>Исполнитель определен</h4>
                            <font class="frlname11"><a href="/users/<?=$model->sbs->performer->username?>"><?=$model->sbs->performer->username?></a></font>
                        </div>
                    <? } ?>

                    <? /*if ($acceptBid) {?>
                        <br />
                        <div class="alert alert-block">
                            <h4>Исполнитель определен</h4>
                            <font class="frlname11"><a href="/users/<?=$acceptBid->userdata->username?>"><?=$acceptBid->userdata->username?></a></font>
                        </div>
                    <? }*/ ?>
                    
                    <? /*if (isset($model->sbs)) {?>
                        <br />
                        <div class="alert alert-block">
                            <? // ---------------- Кнопки управления ответом исполнителя на заказ ---------- ?>
                            <? if ($user->id == $model->sbs->performer->id) { ?>
                                <h4>Сведения о сделке</h4>
                                <p>сумма сделки (рублей): <?=$model->sbs->amount?></p>
                                <p>период (дней): <?=$model->sbs->period?></p>

                                <? if ($model->sbs->status == Sbs::STATUS_NEW) { ?>
                                    <p>
                                        <i class="icon-pencil"></i> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/confirm', array('id'=>$model->sbs->id))?>">Принять предложение</a> 
                                        <i class="icon-remove"></i> <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/reject', array('id'=>$model->sbs->id))?>" class="red">Отказаться</a>
                                    </p>
                                <? } else if ($model->sbs->status == Sbs::STATUS_WAITRESERV) {?>
                                    <p>Ожидание пополнения денег заказчиком</p>
                                <? }  else if ($model->sbs->status == Sbs::STATUS_REJECT) {?>
                                    <p>Вы отказались от выполнения проекта</p>
                                <? } ?>
                            <? } else { ?>
                                <h4>Исполнитель определен</h4>
                                <font class="frlname11"><a href="/users/<?=$acceptBid->userdata->username?>"><?=$acceptBid->userdata->username?></a></font>
                            <? } ?>
                        </div>
                    <? }*/ ?>
                    
                    <? //------------- Проверить: отображать ли форму добавления ответа от исполнителей -------------?>
                    <? //проверка: не определен ли исполнитель ($acceptBid), не гость ли юзер и является ли он исполнителем 
                    if (!$acceptBid && $isLoggedUser && $is_performer) { ?>
                    <div id="respond">
                        <h3>Оставьте своё предложение</h3>
                        <!--<form id="commentform" method="post">-->
                        <?php $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'bid', 
                            'enableClientValidation'=>true,
                            'errorMessageCssClass'=>'alert alert-error',
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                                'validateOnChange'=>true,
                                'validateOnType' => false,
                            ),
                            'htmlOptions' => array('enctype' => 'multipart/form-data'),
                        )); ?>
                            <?php echo $form->errorSummary($bid); ?>
                            <p><b class="btn"><strong>Стоимость</strong></b></p>
                                <?php echo /*'от ' . */ $form->textField($bid, 'budget_start', array('class' => 'inp_text')); ?> <?php echo $form->error($bid, 'budget_start'); ?>
                                <?php //echo 'до ' . $form->textField($bid, 'budget_end', array('class' => 'inp_text')); ?> <?php echo $form->error($bid, 'budget_end'); ?>
                                <?php echo $form->dropDownList($bid, 'currency', $bid->getTenderCurrencyList(), array('style' => 'width:150px')); ?>
                            <p><b class="btn"><strong>Срок</strong></b></p>
                                период: с 
                                <?php //echo $form->textField($bid, 'period_start', array('class' => 'inp_text datepicker')); ?>
                                <?php echo CHtml::textField('Bids[period_start]', date('d.m.Y', $bid->period_start), array(
                                    'class' => 'inp_text datepicker'/*, 'size' => 3*/   
                                    )); ?>
                                по 
                                <?php //echo $form->textField($bid, 'period_end', array('class' => 'inp_text datepicker')); ?>
                                <?php echo CHtml::textField('Bids[period_end]', date('d.m.Y', $bid->period_end), array(
                                    'class' => 'inp_text datepicker'/*, 'size' => 3*/   
                                    )); ?>
                                <?php //echo $form->dropDownList($bid, 'periodby', $bid->getPeriodbyList(), array('style' => 'width:150px')); ?>
                            <p><b class="btn"><strong>Введите сообщение</strong></b></p>
                            <?php echo $form->textArea($bid, 'text', array(
                                'class' => 'area',
                                'rows' => '8',
                                'cols' => '58',
                                'style' => 'width: 758px;',
                            )); ?>
                            <?php echo $form->error($bid,'text'); ?>
                            
                            <?php
                                $this->widget('CMultiFileUpload', array(
                                    'name' => 'attachments',
                                    'max' => $bid->getMax(),
                                    'accept' => 'gif|jpeg|jpg|pdf|png',
                                    'duplicate' => 'Duplicate file!',
                                    'denied' => 'Invalid file type',
                                    'htmlOptions' => array('disabled'=> ($bid->getMax() > 0) ? FALSE : TRUE ),
                                ));     
                            ?>
                            
                            
                            <input type="submit" class="inp_sub" value="<?=($bid->isNewRecord) ? 'Добавить' : 'Сохранить'?>" />
                        <?php $this->endWidget(); ?>
                    </div>
                    <? } ?>

                    <? //------------- Отображение предложения исполнителей (если текущий юзер - заказчик) -------------?>
                    <div class="fon_mess">
                    <? //проверка: юзер - не гость и это юзер - хозяин заказа или исполнитель, который ответил ?>
                    <? if ($isLoggedUser && ($is_owner || ($is_performer && $userBid))) { ?>
                        <h2 class="post-title">Оценка и предложения исполнителей</h2>
                        <?  //если список заявок непустой
                            if (!empty($model->bidslist)) {
                            foreach($model->bidslist as $row) 
                            { //Пройтись по списку 
                                if ($is_owner || ($user->id == $row->user_id)) { //если хозяин заказа или автор ответа - показать ответ ?>
                                <article class="post-67 post type-post status-publish format-standard hentry category-ut-tellus-dolor-dapibus-eget tag-lorem tag-sit-amet post__holder cat-44-id" id="post-67">
                                    <figure class="featured-thumbnail thumbnail">
                                        <a href="../ut-tellus-dolor-dapibus-eget/etiam-dictum-egestas/index.html">
                                            <!--<img width="200" height="150" alt="Фото исполнителя" class="attachment-post-thumbnail wp-post-image" src="">-->
                                            <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row->userdata->userpic?>" alt="Фото исполнителя" class="attachment-post-thumbnail wp-post-image">
                                        </a>
                                        <div class="post_meta meta_type_line">
                                            <div class="post_like">
                                                <a date-type="like" title="Only registered users can vote!" class="not_voting ">
                                                    <i class="icon-thumbs-up"></i>
                                                    <span class="voting_count">0</span>
                                                </a>
                                            </div>
                                            <div class="post_dislike">
                                                <a date-type="dislike" title="Only registered users can vote!" class="not_voting ">
                                                    <i class="icon-thumbs-down"></i>
                                                    <span class="voting_count">0</span>
                                                </a>
                                            </div>
                                        </div>
                                    </figure>
                                    <!-- Post Content -->
                                    <div class="post_content">
                                        <div class="excerpt">
                                            <div class="post_meta meta_type_line">

                                                <div class="post_author">
                                                    <i class="icon-user"></i>
                                                    <a rel="author" title="Автор Professor" href="/users/<?=$row->userdata->username?>"><?=$row->userdata->username?></a>                                
                                                </div>
                                                <div class="post_date">
                                                    <i class="icon-calendar"></i>
                                                    <time datetime="2013-02-14T20:26:57"><?=$row->date()?></time>
                                                </div>
                                                <b class="btno"><strong>Стоимость</strong></b> <?=$row->budget()?><p></p>
                                            </div>

                                            <p><b class="btno"><strong>Описание</strong></b> <?=$row->text?></p>
                                        </div>
                                    </div>            
                                </article>

                                <? // -------- КНОПКИ управления заказом (если юзер - хозяин) ?>
                                <? if ($is_owner) { //если юзер - хозяин и статус заказа=активен ?>
                                    <div class="payd-link">
                                        <? if ($model->status == Tenders::STATUS_OPEN) { //если статус заказа = активен ?>
                                            <? if ($row->status == Bids::STATUS_ACTIVE) { //если статус заказа = активен ?>
                                                <a href="<?=Yii::app()->createAbsoluteUrl('sbs/default/publication', array('id'=>$model->id, 'user'=>$row->userdata->id))?>" class="btn btn-mini" id="all">Выбрать исполнителем</a> 
                                                <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=decline" class="btn btn-mini">Отклонить</a> 
                                            <? } else if ($row->status == Bids::STATUS_ACCEPT || $row->status == Bids::STATUS_ACTIVE) { // ?>
                                                <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=decline" class="btn btn-mini">Отклонить</a> 
                                            <? } else if ($row->status == Bids::STATUS_ACCEPT || $row->status == Bids::STATUS_REJECT) {?>
                                                <p>Исполнитель отказался от выполнения проекта</p> 
                                            <? } ?>
                                        <? } ?>
                                    </div>
                                <? } ?>
                                
                                <div id="bids_<?=$row->id?>" class="post-author clearfix">
                                    <h4 class="post-author_h">Обсуждение проекта</h4>    
                                    <?  //если текущий юзер = хозяин заказа или текущий юзер-исполнитель = автор данного ответа
                                    if ($is_owner || $row->user_id == Yii::app()->user->id) 
                                    {
                                        if ($row->LettersCount) { // если колво писем есть
                                             foreach($row->letters as $letter)  { //пройтись по письмам 
                                                $this->renderPartial('_bidletter', array('letter'=>$letter));
                                             } 
                                        } else { ?>
                                            <p class="nocomments">Комментариев еще нет</p>
                                    <? } 
                                    } ?>
                                </div>   
                                
                                <p>
                                    <b class="btn" href="" onclick="$('#bid_' + <?=$row->id?>).slideDown()">
                                        <strong>Написать сообщение</strong>
                                    </b>
                                </p>
                                
                                <form action="#" method="post" accept-charset="cp-1251" id="bid_<?=$row->id?>" style="display: none;">
                                    <fieldset class="publish">
                                        <label>Ответ:</label>
                                        <div class="bo">
                                            <textarea name="text" style="height: 70px; margin-left: 10px; width: 738px;"></textarea>
                                            <div class="button_b left">
                                                <div>
                                                    <input type="button" value="Отправить" onclick="send(<?=$row->id?>);" />
                                                    <span></span>
                                                </div>
                                            </div><!-- end_button -->
                                        </div><!-- end_box -->
                                    </fieldset>
                                </form><br />
                                
                        <?      } 
                            }
                        } else { ?>
                            <p><strong>Заявки отсутствуют.</strong></p>
                        <?  } ?> 
                    <? }  ?> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>