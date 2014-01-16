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

                                <h3 class="title">Контактные данные</h3>
                                <p class="subtitle">Контактные данные доступны только пользователям из вашего контакт листа</p>

                                <?php $form = $this->beginWidget('CActiveForm', array(
                                        'enableClientValidation'=>true,
                                        'errorMessageCssClass'=>'alert alert-error',
                                        'clientOptions'=>array(
                                            'validateOnSubmit'=>true,
                                            'validateOnChange'=>true,
                                        ),
                                    )); 
                                ?>

                                <table class="profile">
                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'email'); ?></td>
                                        <td>
                                            <?php echo $form->textField($model,'email'); ?>
                                            <?php echo $form->error($model,'email'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'icq'); ?></td>
                                        <td>
                                            <?php echo $form->textField($model,'icq'); ?>
                                            <?php echo $form->error($model,'icq'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'skype'); ?></td>
                                        <td>
                                            <?php echo $form->textField($model,'skype'); ?>
                                            <?php echo $form->error($model,'skype'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'telephone'); ?></td>
                                        <td>
                                            <?php echo $form->textField($model,'telephone'); ?>
                                            <?php echo $form->error($model,'telephone'); ?>
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