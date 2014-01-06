<style type="text/css">
    .page.selected a {
        color: #999999;
        cursor: default;   
        background-color: #F5F5F5     
    }
</style>

<div class="row">
    <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">
        <div class="row">
            <div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
                <section class="title-section">
                    <h1 class="title-header">
                        Лента заказов </h1>
                    <!-- BEGIN BREADCRUMBS-->
                    <ul class="breadcrumb breadcrumb__t">
                        <li><a href="index.html">Лента заказов</a></li>
                        <li class="divider"></li>
                        <li><a href="../index.html">Дипломы</a></li>
                </section>
                <!-- .title-section -->
            </div>
        </div>
        <div class="row">
            <div class="span8 right" id="content" data-motopress-type="loop"
                 data-motopress-loop-file="loop/loop-testi.php">


                <?php 
                $this->widget('zii.widgets.CListView',
                    array(
                        'dataProvider'       => $dataProvider,
                        'itemView'           => '_view',
                        'ajaxUpdate'         => false, //отключаем обновлениея аяксом (так хочет PM )))
                        'emptyText'          => '<div class="alert alert-error">Ничего не найдено</div>',
                        'template'           => '
<div class="row-fluid">
<div class="span6">
{sorter}
</div><div class="span6">
</div>
</div>
{items}
<div class="row-fluid"><div class="span12">
{pager}</div></div>',
                        'sorterCssClass'     => 'offers-stateline',
                        'sorterHeader'       => 'Сортировать по: ',
                        'pager'              => array(
                            'maxButtonCount' => 8,
                            'nextPageLabel'  => 'Следующая',
                            'prevPageLabel'  => 'Предыдущая',
                            'lastPageLabel'  => 'Последняя',
                            'firstPageLabel' => 'Первая',
                            
                            'header'         => '',
                            //'selectedPageCssClass' => 'active',
                            //'previousPageCssClass' => '',
                            'htmlOptions' => array(
                                'class' => '',
                                'style' => 'margin:0;'
                            )
                        ),
                        'pagerCssClass' => 'pagination pagination__posts',
                        
                        'sortableAttributes' => array(
                            'date'   => 'Дате',
                            'budget' => 'Бюджету',
                        ),

                    ));
                ?>
            </div>
            <div class="span4">

                <div class="sidebar" id="sideLeft">
                    <? $this->widget('MenuWidget') ?>


                    <? $this->widget('SidebarWidget') ?>


                </div><!-- .sidebar#sideLeft -->
            </div>
        </div>
    </div>
</div>

