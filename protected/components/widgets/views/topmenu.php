<?php 
    $moduleid = Yii::app()->controller->module->id;
    $controllerid = Yii::app()->controller->id;
    $actionid = Yii::app()->controller->action->id;
    $status = Yii::app()->request->getParam('status');
    
    $is_customer = ($user->usertype == User::USERTYPE_CUSTOMER);    //признак юзер=заказчик
    $is_performer = ($user->usertype == User::USERTYPE_PERFORMER);  //признак юзер=исполнитель
    
?>
<div class="row">
    <div class="row-fluid">
        <div class="span6 offset5">
            
            <p>&nbsp;</p>
            <p>
                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/05_blog3.jpg"></a>
                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/05_blog.jpg"></a>

                <span style="margin-left: 20px;"><?= $user->username?>
                    <a class="green-submit" href="<?= Yii::app()->createAbsoluteUrl('logout') ?>">Выход</a>
                </span>
            </p>
        </div>
    </div>
    
    <!--<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">-->
        
        <div class="filter-wrapper clearfix">
            <strong>Заказы: </strong>
            <ul id="filters" class="filter nav nav-pills">

                <!--<li <? //if ($moduleid == 'sbs' && $actionid == 'index') { ?> class="active"<? //} ?>>
                    <a href="<? /*echo Yii::app()->createAbsoluteUrl('sbs')*/?>" data-count="13" data-filter>СБС</a>
                </li>-->
            
                <? if ($is_performer) { ?>
                    <li <? if ($status == 'auction') { ?> class="active"<? } ?>>
                        <a href="<? echo Yii::app()->createAbsoluteUrl('sbs')?>" data-count="<?=$offerCount?>" data-filter>Предложение (<?=$offerCount?>)</a>
                    </li>
                <? } ?>
            
                <? /*if ($is_performer) { ?>
                    <li <? if ($moduleid == 'tenders' && $actionid == 'index') { ?> class="active"<? } ?>>
                        <a href="index.html#" data-count="13" data-filter>Лента заказов</a>
                    </li>
                <? }*/ ?>

                <? if ($is_customer) { ?>
                    <li <? if ($status == 'auction') { ?> class="active"<? } ?>>
                        <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/auction')?>" data-count="<?=$auctionCount?>" data-filter>В аукционе (<?=$auctionCount?>)</a>
                    </li>
                <? } else if ($is_performer) { ?>
                    <li <? if ($status == 'working') { ?> class="active"<? } ?>>
                        <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/working')?>" data-count="<?=$workingCount?>" data-filter>В работе (<?=$workingCount?>)</a>
                    </li>
                <? } ?>
                
                <li <? if ($status == 'warranty') { ?> class="active"<? } ?>>
                    <a href="index.html#" data-count="4" class="academic">На гарантии (0)</a>
                </li>
                <li <? if ($status == 'arbitration') { ?> class="active"<? } ?>>
                    <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/arbitration')?>" data-count="<?=$countArbitration?>" class="academic">В арбитраже (<?=$countArbitration?>)</a>
                </li>
                <li <? if ($status == 'closed') { ?> class="active"<? } ?>>
                    <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/closed')?>" data-count="<?=$countClosed?>" class="academic">Завершенные (<?=$countClosed?>)</a>
                </li>            
                
                <? if ($is_performer) { ?>
                    <li <? if ($status == 'declined') { ?> class="active"<? } ?>>
                        <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/working')?>" data-count="<?=$declinedCount?>" data-filter>Отклоненные (<?=$declinedCount?>)</a>
                    </li>
                <? } ?>
                
            </ul>
            <div class="clear"></div>
        </div>
    <!--</div>-->
</div>
