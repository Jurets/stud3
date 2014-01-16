<!--<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? //$this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">
      -->
                        <h3 class="title">Пароль</h3>
                        <?php $this->widget('FlashMessages'); ?>

                        <?php echo $this->renderPartial('head'); ?>

                        <div id="container">
                            <div id="content">

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
                                        <td class="caption"><?php echo $form->labelEx($model, 'password'); ?></td>
                                        <td>
                                            <?php echo $form->passwordField($model,'password'); ?>
                                            <?php echo $form->error($model,'password'); ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="caption"><?php echo $form->labelEx($model, 'password2'); ?></td>
                                        <td>
                                            <?php echo $form->passwordField($model,'password2'); ?>
                                            <?php echo $form->error($model,'password2'); ?>
                                        </td>
                                    </tr>

                                </table>

                                <button type="submit" class="btn">Сохранить</button>

                                <?php $this->endWidget(); ?>

                            </div><!-- #content-->
                        </div><!-- #container-->

                        <!-- <div class="sidebar" id="sideLeft">
                            <?php //echo $this->renderPartial('block'); ?>
                        </div> -->
<!--
                    </div>
                    <? //$this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>-->
<!--End #motopress-main-->        