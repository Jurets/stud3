<!--<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">

                <? //$this->widget('HeaderWidget');  // вьюшка хедера кабинета (повторяется на разных страницах кабинета) ?>

                <div class="row">
                    <div class="span8">
    -->
                        <h3 class="title">Навыки</h3>
                        <?php $this->widget('FlashMessages'); ?>

                        <?php echo $this->renderPartial('head'); ?>

                        <div id="yui-main">
                            <div class="yui-b">
                                <?php $this->widget('FlashMessages'); ?>

                                    <?php $form = $this->beginWidget('CActiveForm'); ?>
                                    <p class="subtitle">Укажите через запятую ваши навыки, по которым вас смогут найти в каталоге</p>

                                    <table class="profile">
                                        <tr>
                                            <td class="caption">Навыки:</td>
                                            <td class="frnt">
                                                <?php
                                                    $this->widget('application.extensions.tag.TagWidget', array(
                                                        'url'=> '/user/account/json/',
                                                        'tags' => $model->getTags(),
                                                    ));
                                                ?>
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
<!--
                    </div>
                    <? //$this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>
                </div>

            </div>
        </div>
    </div>
</div>-->
<!--End #motopress-main-->