<!--<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? //$this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">
-->
                        <h3>Сервис безопасной сделки</h3>
                        <?php $this->widget('FlashMessages'); ?>

                        <p class="subtitle">
                        <strong><a href="/sbs">Все</a> (<?=$countAll?>)</strong> 
                        <strong><a href="/sbs?status=<?=Sbs::STATUS_NEW?>">Не начатые </a> (<?=$countNew?>)</strong> 
                        <strong><a href="/sbs?status=<?=Sbs::STATUS_ACTIVE?>">Активные </a> (<?=$countActive?>)</strong> 
                        <strong><a href="/sbs?status=<?=Sbs::STATUS_COMPLETE?>">Завершенные </a> (<?=$countCompleted?>)</strong> 
                        <strong><a href="/sbs?status=<?=Sbs::STATUS_CLOSE?>">Отмененные</a> (<?=$countClosed?>)</strong>
                        </p>

                        <div><a class="btn" href="/account/tenders"><strong>Начать СБС</strong></a></div><br />

                        <?php 
                        $this->widget('zii.widgets.CListView', 
                        array(
	                        'dataProvider' => $dataProvider,
	                        'itemView' => 'sbs/_view',
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
                        ));
                        ?>
<!--
                    </div>
                    <? //$this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>-->
<!--End #motopress-main-->                                    