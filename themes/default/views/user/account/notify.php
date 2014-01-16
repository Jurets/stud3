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

                                <h3>Оповещения</h3>

                                <?php $this->widget('FlashMessages'); ?>

                                <?php $form = $this->beginWidget('CActiveForm', array(
                                        'enableClientValidation'=>true,
                                        'errorMessageCssClass'=>'alert alert-error',
                                        'clientOptions'=>array(
                                            'validateOnSubmit'=>true,
                                            'validateOnChange'=>true,
                                        ),
                                    )); 
                                ?>

                                <table class="setting">
                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'mailer'); ?></td>
                                        <td>
                                            <?php echo $form->checkBox($model, 'mailer'); ?>
                                        </td>
                                    </tr>

                                </table>

                                <p class="subtitle">Уведомления о событиях</p>
                                <table class="setting">
                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'invite'); ?></td>
                                        <td>
                                            <?php echo $form->checkBox($model, 'invite'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'blogs'); ?></td>
                                        <td>
                                            <?php echo $form->checkBox($model, 'blogs'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'projects'); ?></td>
                                        <td>
                                            <?php echo $form->checkBox($model, 'projects'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'items'); ?></td>
                                        <td>
                                            <?php echo $form->checkBox($model, 'items'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'messages'); ?></td>
                                        <td>
                                            <?php echo $form->checkBox($model, 'messages'); ?>
                                        </td>
                                    </tr>

                                </table>



                                <div class="form-actions">
                                    <button type="submit" class="btn">Сохранить</button>
                                </div>

                                <?php $this->endWidget(); ?>



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