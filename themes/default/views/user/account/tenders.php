<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? $this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">
                        <h3>Проекты</h3>
                        <?php $this->widget('FlashMessages'); ?>

                        <div><a class="btn" href="/tenders/publication"><strong>Опубликовать проект</strong></a></div><br />

                        <?php 
                        $this->widget('zii.widgets.CListView', 
                        array(
                            'dataProvider' => $dataProvider,
                            'itemView' => 'tenders/_view',
                            'ajaxUpdate' => true,
                            'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
                            'template' => '
                        <table class="listorder">
                        {items}
                        </table>
                        <br />
                        {pager}', 
                            'sorterCssClass' => 'offers-stateline',
                            'sorterHeader' => 'Сортировать по: ',
                            'pager' => array(
                                'header'=>'',
                            ),
                            'sortableAttributes'=>array(
                                'date' => 'Дате'
                            ),
                        )); ?>
                        
                    </div>
                    <? $this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>
<!--End #motopress-main-->