<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? $this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">

                        <?php $this->widget('FlashMessages'); ?>
                        <?php echo $this->renderPartial('head'); ?>

                        <div id="yui-main">
                            <div class="yui-b">

                                <h3>Баланс</h3>

                                <div id="msearch">
                                    <form id="pay" name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp"> 
                                        <input type="hidden" name="LMI_PAYEE_PURSE" value="<? echo $purse ?>">
                                        <input type="hidden" name="user_id" value="<? echo Yii::app()->user->id ?>">

                                        <div>Сумма: <input name="LMI_PAYMENT_AMOUNT" type="text" maxlength="6"></div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn">Пополнить</button>
                                        </div>

                                    </form>
                                </div>


                            </div>
                        </div>
                        <!--/yui-main-->

                        <?php //echo $this->renderPartial('block'); ?>

                    </div>
                    <? $this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>
<!--End #motopress-main-->