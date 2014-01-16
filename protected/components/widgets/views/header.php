<?php 
    $moduleid = Yii::app()->controller->module->id;
    $controllerid = Yii::app()->controller->id;
    $actionid = Yii::app()->controller->action->id;
    $status = Yii::app()->request->getParam('status');
?>
<div class="row">
    <div class="row-fluid">
        <div class="span6 offset6">
            <p>&nbsp;</p>
            <p>
                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/05_blog3.jpg"></a>
                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/05_blog.jpg"></a>
            </p>
        </div>
    </div>
    
    <div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
        <section class="title-section2">
            <h1 class="title-header"><?=$this->controller->pageTitle?></h1>
            <ul class="breadcrumb breadcrumb__t"><li><a href="index.html">Кабинет</a></li>
        </section>
        
        <div class="filter-wrapper clearfix">
            <strong>Заказы: </strong>
            <ul id="filters" class="filter nav nav-pills">

                <!--<li <? //if ($moduleid == 'sbs' && $actionid == 'index') { ?> class="active"<? //} ?>>
                    <a href="<? /*echo Yii::app()->createAbsoluteUrl('sbs')*/?>" data-count="13" data-filter>СБС</a>
                </li>-->
            
                <? if ($user->usertype == User::USERTYPE_PERFORMER) { ?>
                    <li <? if ($moduleid == 'tenders' && $actionid == 'index') { ?> class="active"<? } ?>>
                        <a href="index.html#" data-count="13" data-filter>Лента заказов</a>
                    </li>
                <? } ?>

                <li <? if ($status == 'auction') { ?> class="active"<? } ?>>
                    <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/auction')?>" data-count="<?=$auctionCount?>" data-filter>В аукционе (<?=$auctionCount?>)</a>
                </li>
                <li <? if ($status == 'warranty') { ?> class="active"<? } ?>>
                    <a href="index.html#" data-count="4" class="academic">На гарантии (0)</a>
                </li>
                <li <? if ($status == 'arbitration') { ?> class="active"<? } ?>>
                    <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/arbitration')?>" data-count="<?=$countArbitration?>" class="academic">В арбитраже (<?=$countArbitration?>)</a>
                </li>
                <li <? if ($status == 'closed') { ?> class="active"<? } ?>>
                    <a href="<?=Yii::app()->createAbsoluteUrl('account/tenders/closed')?>" data-count="<?=$countClosed?>" class="academic">Завершенные (<?=$countClosed?>)</a>
                </li>            
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
