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
                    <article class="testimonial clearfix">
                        <blockquote class="testimonial_bq">
                            <div class="testimonial_content">
                                <div class="post_meta meta_type_line">

                                    <div class="post_author">
                                        <i class="icon-user"></i>
                                        <a rel="author" title="<?= $model->userdata->nickname ?>" href="<?=Yii::app()->createAbsoluteUrl('users/'.$model->userdata->username)?>"><?= $model->userdata->nickname ?></a>                                
                                    </div>
                                    <div class="post_date">
                                        <i class="icon-calendar"></i>
                                        <time datetime="2013-02-14T20:26:57"><?= $model->dateLong ?></time>
                                    </div>

                                </div>
                                <h4><?=$model->title?></h4>

                                <p><b class="btno"><strong>Описание:</strong></b> <?=$model->text?></p>
                                <p>&nbsp;</p>
                                <table width="100%">
                                    <tbody><tr>
                                            <td width="40%">
                                                <p><b class="btno"><strong>Тип работы:</strong></b> <?= $model->tendercategory->name ?></p>
                                            </td>
                                            <td width="60%">
                                                <p><b class="btno"><strong>Специализация:</strong></b> <?= $model->specialityString ?></p>
                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td width="40%">
                                                <p><b class="btno"><strong>Кол-во страниц:</strong></b> <?= $model->pages ?></p>
                                            </td>
                                            <td width="60%">
                                                <p><b class="btno"><strong>Размер шрифта:</strong></b> <?= $model->font ?></p>
                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td width="40%">
                                                <p><b class="btno"><strong>Процент на антиплагиате:</strong></b> <?= $model->percent ?></p>
                                            </td>
                                            <td width="60%">
                                                <p><b class="btno"><strong>Дата сдачи:</strong></b> <?= $model->dateEndMedium ?></p>
                                            </td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        <tr>
                                            <td width="40%">
                                                <p><b class="btno"><strong>Дополнительные файлы:</strong></b><br>
                                                    файлов нет</p>
                                            </td>
                                            <td width="60%">

                                            </td>
                                        </tr>
                                    </tbody></table>
                                <p>&nbsp;</p>
                                <p>предложений: <?= $model->BidCount ?></p>
                                <!--<p style="text-align:right;"><a href="">подробнее...</a></p>-->
                            </div>
                        </blockquote>
                    </article>
                    
                    <? //неавторизированные пользователи и заказчики видят вместо формы надпись ?>
                    <? if (!$isLoggedUser || ($is_customer && !$is_owner)) {?>
                        <div class="alert alert-block">
                            <h4>Чтобы ответить на заказ необходимо зарегистрироваться как исполнитель</h4>
                        </div>
                    <? } ?>
                    
                    <? //------------- Проверить наличие исполнителя -------------?>
                    <? if ($acceptBid) {?>
                        <br />
                        <div class="alert alert-block">
                            <h4>Исполнитель определен</h4>
                            <font class="frlname11"><a href="/users/<?=$acceptBid->userdata->username?>"><?=$acceptBid->userdata->username?></a></font>
                        </div>
                    <? } ?>
                    
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
                                от <?php echo $form->textField($bid, 'period_start', array('class' => 'inp_text datepicker'/*, 'size' => 3*/)); ?>
                                до <?php echo $form->textField($bid, 'period_end', array('class' => 'inp_text datepicker'/*, 'size' => 3*/)); ?>
                                <?php //echo $form->dropDownList($bid, 'periodby', $bid->getPeriodbyList(), array('style' => 'width:150px')); ?>
                            <p><b class="btn"><strong>Введите сообщение</strong></b></p>
                            <?php echo $form->textArea($bid, 'text', array(
                                'class' => 'area',
                                'rows' => '8',
                                'cols' => '58',
                                'style' => 'width: 758px;',
                            )); ?>
                            <?php echo $form->error($bid,'text'); ?>
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

                                <? // ---------------- Кнопки управления ответом исполнителя на заказ ----------?>
                                <? if (Yii::app()->user->id == $row->user_id && $row->status == Bids::STATUS_ACTIVE) { ?>
                                    <i class="icon-pencil"></i> <a href="/tenders/<?=$row->project_id?>.html?action=edit#bid">Редактировать</a> 
                                    <i class="icon-remove"></i> <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=reject" class="red">Отказать от проекта</a>
                                <? } ?>

                                <? // -------- КНОПКИ управления заказом (если юзер - хозяин) ?>
                                <? if ($is_owner) { //если юзер - хозяин и статус заказа=активен ?>
                                    <div class="payd-link">
                                        <? if ($row->status == Bids::STATUS_ACTIVE) { //если статус заказа = активен ?>
                                            <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=accept" class="btn btn-mini" id="all">Выбрать исполнителем</a> 
                                            <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=decline" class="btn btn-mini">Отклонить</a> 
                                        <? } else if ($row->status == Bids::STATUS_ACCEPT || $row->status == Bids::STATUS_ACTIVE) { // ?>
                                            <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=decline" class="btn btn-mini">Отклонить</a> 
                                        <? } else if ($row->status == Bids::STATUS_ACCEPT || $row->status == Bids::STATUS_REJECT) {?>
                                            <p>Исполнитель отказался о твыполнения проекта</p> 
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
                
                <!--<div data-motopress-sidebar-file="sidebar.php" data-motopress-type="static-sidebar" id="sidebar" class="span4 sidebar">

                    <div class="widget" id="categories-2">
                    <h3>Categories</h3>        
                    <ul>
                            <li class="cat-item cat-item-45"><a title="Просмотреть все записи в рубрике «Aenean auctor wisi et urn»" href="category/aenean-auctor-wisi-et-urn/index.html">Aenean auctor wisi et urn</a>
                            </li>
                            <li class="cat-item cat-item-3"><a title="Просмотреть все записи в рубрике «Aenean nonummy hendrerit mauris»" href="category/aenean-nonummy-hendrerit-mauris/index.html">Aenean nonummy hendrerit mauris</a>
                            </li>
                            <li class="cat-item cat-item-1"><a title="Просмотреть все записи в рубрике «Cum sociis natoque penatibus etm»" href="category/cum-sociis-natoque-penatibus-etm/index.html">Cum sociis natoque penatibus etm</a>
                            </li>
                            <li class="cat-item cat-item-42"><a title="Просмотреть все записи в рубрике «Donec accumsan malesuada orci»" href="category/donec-accumsan-malesuada-orci/index.html">Donec accumsan malesuada orci</a>
                            </li>
                            <li class="cat-item cat-item-5"><a title="Просмотреть все записи в рубрике «Fusce feugiat malesuada odio»" href="category/fusce-feugiat-malesuada-odio/index.html">Fusce feugiat malesuada odio</a>
                            </li>
                            <li class="cat-item cat-item-4"><a title="Просмотреть все записи в рубрике «Fusce suscipit varius mi»" href="category/fusce-suscipit-varius-mi/index.html">Fusce suscipit varius mi</a>
                            </li>
                            <li class="cat-item cat-item-46"><a title="Просмотреть все записи в рубрике «Integer rutrum ante eu lacus»" href="category/integer-rutrum-ante-eu-lacus/index.html">Integer rutrum ante eu lacus</a>
                            </li>
                            <li class="cat-item cat-item-43"><a title="Просмотреть все записи в рубрике «Lorem ipsum dolor sit amet consecte»" href="category/lorem-ipsum-dolor-sit-amet-consecte/index.html">Lorem ipsum dolor sit amet consecte</a>
                            </li>
                            <li class="cat-item cat-item-41"><a title="Просмотреть все записи в рубрике «Morbi nunc odio gravida at cursus nec»" href="category/morbi-nunc-odio-gravida-at-cursus-nec/index.html">Morbi nunc odio gravida at cursus nec</a>
                            </li>
                            <li class="cat-item cat-item-2"><a title="Просмотреть все записи в рубрике «Praesent vestibulum molestie la»" href="category/praesent-vestibulum-molestie-la/index.html">Praesent vestibulum molestie la</a>
                            </li>
                            <li class="cat-item cat-item-44"><a title="Просмотреть все записи в рубрике «Ut tellus dolor dapibus eget»" href="category/ut-tellus-dolor-dapibus-eget/index.html">Ut tellus dolor dapibus eget</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget" id="archives-2"><h3>Archives</h3>        
                        <ul>
                            <li><a href="2013/03/index.html">Март 2013</a></li>
                            <li><a href="2013/02/index.html">Февраль 2013</a></li>
                            <li><a href="2013/01/index.html">Январь 2013</a></li>
                            <li><a href="2012/12/index.html">Декабрь 2012</a></li>
                            <li><a href="2012/05/index.html">Май 2012</a></li>
                        </ul>
                    </div>                    
                </div>-->
            </div>
        </div>
    </div>
    </div>