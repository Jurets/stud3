<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? $this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">
                        <h3>Фотография</h3>
                        <?php $this->widget('FlashMessages'); ?>

                        <?php echo $this->renderPartial('head'); ?>


                        <div id="container">
                            <div id="content">

                                <?php $form=$this->beginWidget('CActiveForm', array(
                                        'errorMessageCssClass' => 'alert alert-error',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                                    )); ?>

                                <table class="images">
                                    <tr>
                                        <td width="200">
                                            <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$model->userpic_f?>" alt=""><br>
                                            <ul class="nav nav-list">
                                                <li><a href="#" onclick="crop.open()"><i class="icon-pencil"></i> Изменить миниатюру</a></li>
                                                <li><a href="/user/account/deleteuserpic" onclick="crop.open()"><i class="icon-remove"></i> Удалить</a></li>
                                            </ul>
                                            <br />
                                            Загрузить фотографию<br />
                                            <?php echo CHtml::activeFileField($model, 'userpic'); ?>
                                            <?php echo $form->error($model,'userpic'); ?>
                                        </td>
                                        <td valign="top">
                                            <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$model->userpic?>" alt="">
                                        </td>
                                    </tr>         
                                </table>

                                <br>
                                <div class="form-actions">
                                    <button type="submit" class="btn">Загрузить</button>
                                </div>



                                <?php $this->endWidget(); ?>

                            </div><!-- #content-->
                        </div><!-- #container-->

                        <!-- <div class="sidebar" id="sideLeft">
                            <?php //echo $this->renderPartial('block'); ?>
                        </div> -->

                    </div>
                    <? $this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>
<!--End #motopress-main-->                    