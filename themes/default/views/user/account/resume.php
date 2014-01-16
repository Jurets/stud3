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

                                <h3 class="title">Резюме</h3>
                                <p class="subtitle">Подробное описание</p>

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

                                <?php $this->widget('EMarkitupWidget',array('attribute' => 'full_descr', 'model' => $model));?>

                                <?php echo $form->error($model,'full_descr'); ?>

                                <div class="form-actions">
                                    <button type="submit" class="btn">Сохранить</button>
                                </div>

                                <?php $this->endWidget(); ?>



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