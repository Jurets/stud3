<script type="text/javascript">
    $(function ()
        {
            $('#days_select').bind('change',function(){
                var id = $(this).val();
                id = parseInt(id);
                var amount;
                switch(id) {
                    case 1:  amount = parseInt(<?=$data[Tariffs::PRO]['price']?>); break
                    case 3:  amount = parseInt(<?=$data[Tariffs::PRO]['price3']?>); break
                    case 6:  amount = parseInt(<?=$data[Tariffs::PRO]['price6']?>); break
                    case 12: amount = parseInt(<?=$data[Tariffs::PRO]['price12']?>); break
                }
                $('#amount').html(amount);
            });
    });
</script>

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

                                <div class="yui-gc">

                                    <div class="yui-u first">
                                        <?php $form = $this->beginWidget('CActiveForm', array())?>
                                        <table class="tariffs">
                                            <tr>
                                                <th class="txtl" width="200px"></th>
                                                <th><?=$data[Tariffs::START]['name']?></th>
                                                <th><strong><?=$data[Tariffs::PRO]['name']?></strong></th>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><strong>Общие</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><?php echo $form->labelEx($model, 'commission'); ?></td>
                                                <td class="budget txtc"><?=$data[Tariffs::START]['commission']?>%</td>
                                                <td class="budget txtc"><strong><?=$data[Tariffs::PRO]['commission']?>%</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><?php echo $form->labelEx($model, 'catalog'); ?></td>
                                                <td class="budget txtc"><? if( $data[Tariffs::START]['catalog'] ): ?>Да<? else: ?>Нет<? endif; ?></td>
                                                <td class="budget txtc"><strong><? if( $data[Tariffs::PRO]['catalog'] ): ?>Да<? else: ?>Нет<? endif; ?></strong></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><strong>Фрилансеры</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><?php echo $form->labelEx($model, 'sections'); ?></td>
                                                <td class="budget txtc"><?=$data[Tariffs::START]['sections']?></td>
                                                <td class="budget txtc"><strong><?=$data[Tariffs::PRO]['sections']?></strong></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><?php echo $form->labelEx($model, 'place'); ?></td>
                                                <td class="budget txtc"><? if( $data[Tariffs::START]['place'] ): ?>Да<? else: ?>Нет<? endif; ?></td>
                                                <td class="budget txtc"><strong><? if( $data[Tariffs::PRO]['place'] ): ?>Да<? else: ?>Нет<? endif; ?></strong></td>
                                            </tr>

                                            <tr>
                                                <td colspan="3"><strong>Работадатели</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="title"><?php echo $form->labelEx($model, 'logo'); ?></td>
                                                <td class="budget txtc"><? if( $data[Tariffs::START]['logo'] ): ?>Да<? else: ?>Нет<? endif; ?></td>
                                                <td class="budget txtc"><strong><? if( $data[Tariffs::PRO]['logo'] ): ?>Да<? else: ?>Нет<? endif; ?></strong></td>
                                            </tr>

                                        </table>
                                        <?php $this->endWidget(); ?>

                                    </div>

                                    <div class="yui-u">

                                        <? if( $user->tariff != Tariffs::PRO ): ?>
                                            <div id="msearch">

                                                <div><strong>Покупка PRO тарифа </strong></div>

                                                <?php $form = $this->beginWidget('CActiveForm', array(
                                                        'enableClientValidation'=>true,
                                                        'errorMessageCssClass'=>'alert alert-error',
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                            'validateOnChange'=>true,
                                                        ),
                                                    )); 
                                                ?>
                                                <?php echo $form->error($SetTariff, 'period'); ?>

                                                <div>
                                                    <?php echo $form->dropDownList($SetTariff, 'period', array('1' => '1 месяц', '3' => '3 месяца', '6' => '6 месяцев', '12' => '1 год'), array('id' => 'days_select')); ?>
                                                </div>
                                                
                                                <div>Сумма: <b class="amount" id="amount"><?=$data[Tariffs::PRO]['price']?></b> рублей</div> 
                                                <div><input type="submit" value="Купить"></div>
                                                <?php $this->endWidget(); ?>
                                            </div>

                                            <? else: ?>

                                            <div id="msearch">

                                                <div><strong>Продление PRO тарифа </strong></div>
                                                <div>Осталось: <?=Date_helper::date_await($UsersTariff->period)?></div>

                                                <?php $form = $this->beginWidget('CActiveForm', array(
                                                        'enableClientValidation'=>true,
                                                        'errorMessageCssClass'=>'alert alert-error',
                                                        'clientOptions'=>array(
                                                            'validateOnSubmit'=>true,
                                                            'validateOnChange'=>true,
                                                        ),
                                                    )); 
                                                ?>
                                                <?php echo $form->error($SetTariff, 'period'); ?>

                                                <div>
                                                    <?php echo $form->dropDownList($SetTariff, 'period', array('1' => '1 месяц', '3' => '3 месяца', '6' => '6 месяцев', '12' => '1 год'), array('id' => 'days_select')); ?>
                                                </div>
                                                
                                                <div>Сумма: <b class="amount" id="amount"><?=$data[Tariffs::PRO]['price']?></b> рублей</div> 
                                                <div><input type="submit" value="Продлить"></div>
                                                <?php $this->endWidget(); ?>
                                            </div>
                                            <? endif; ?>

                                    </div>

                                </div>


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