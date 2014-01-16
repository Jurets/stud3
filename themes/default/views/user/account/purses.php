<!--<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? //$this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">
    -->
                        <?php $this->widget('FlashMessages'); ?>
                        <?php echo $this->renderPartial('head'); ?>

                        <div id="yui-main">
                            <div class="yui-b">

                                <h1>Кошельки</h1>

                                <?php $this->widget('FlashMessages'); ?>

                                <div><a class="btn" href="/account/addpurse">Добавить</a></div><br />

                                <?php 
                                    $this->widget('zii.widgets.CListView', 
                                        array(
                                            'dataProvider' => $dataProvider,
                                            'itemView' => 'purses/_view',
                                            'ajaxUpdate' => true,
                                            'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
                                            'template' => '
                                            {sorter}
                                            <table class="offers">
                                            <tr>
                                            <th class="txtl" style="width:100px;">Номер кошелька</th>
                                            <th style="width:100px;">Сумма выплат</th>
                                            <th style="width:150px;">Дата создания</th>
                                            <th style="width:150px;">Последняя операция</th>
                                            <th></th>
                                            </tr>
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
                                                'date' => 'Дате',
                                                'amount' => 'Сумме'
                                            ),
                                    ));
                                ?>

                            </div>
                        </div>
                        <!--/yui-main-->

                        <?php //echo $this->renderPartial('block'); ?>
<!--
                    </div>
                    <? //$this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>-->
<!--End #motopress-main-->