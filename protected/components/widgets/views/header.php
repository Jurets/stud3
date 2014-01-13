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
                <? if ($user->usertype == User::USERTYPE_CUSTOMER) { ?>
                    <li class="active">
                        <a href="index.html#" data-count="13" data-filter>Лента заказов</a>
                    </li>
                <? } ?>

                <li class="active">
                    <a href="index.html#" data-count="13" data-filter>В аукционе (<?=$auctionCount?>)</a>
                </li>
                <li>
                    <a href="index.html#" data-count="4" class="academic">На гарантии (0)</a>
                </li>
                <li>
                    <a href="index.html#" data-count="4" class="academic">В арбитраже (0)</a>
                </li>
                <li>
                    <a href="index.html#" data-count="4" class="academic">Завершенные (0)</a>
                </li>            
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
