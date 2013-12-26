<div class="row">
    <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">
        <div class="row">
            <div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
                <section class="title-section">
                    <h1 class="title-header">
                        Лента заказов </h1>
                    <!-- BEGIN BREADCRUMBS-->
                    <ul class="breadcrumb breadcrumb__t">
                        <li><a href="index.html">Ленна заказов</a></li>
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
                        'ajaxUpdate'         => true,
                        'emptyText'          => '<div class="alert alert-error">Ничего не найдено</div>',
                        'template'           => '
<div class="row-fluid">
<div class="span6">
{sorter}
</div><div class="span6">
{pager}
</div>
</div>
{items}
<div class="row-fluid"><div class="span12">
{pager}</div></div>',
                        'sorterCssClass'     => 'offers-stateline',
                        'sorterHeader'       => 'Сортировать по: ',
                        'pager'              => array(
                            'maxButtonCount' => 0,
                            'nextPageLabel'  => 'Следующая',
                            'prevPageLabel'  => 'Предыдущая',
                            'header'         => '',
                            'htmlOptions' => array(
                                'style' => 'margin:0;'
                            )

                        ),
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

