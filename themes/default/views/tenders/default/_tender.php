<article class="testimonial clearfix">
    <blockquote class="testimonial_bq">
        <div class="testimonial_content">
            <div class="post_meta meta_type_line">

                <div class="post_author">
                    <i class="icon-user"></i>
                    <a rel="author" title="<?= $model->userdata->nickname ?>" href="<?=Yii::app()->createAbsoluteUrl('users/'.$model->userdata->username)?>"><?= $model->userdata->nickname ?></a>                                
                </div>
                <div class="post_date">
                    <i class="icon-calendar"></i>
                    <time datetime="2013-02-14T20:26:57"><?= $model->dateLong ?></time>
                </div>

            </div>
            <h4><?=$model->title?></h4>

            <p><b class="btno"><strong>Описание:</strong></b> <?=$model->text?></p>
            <p>&nbsp;</p>
            <table width="100%">
                <tbody><tr>
                        <td width="40%">
                            <p><b class="btno"><strong>Тип работы:</strong></b> <?= $model->tendercategory->name ?></p>
                        </td>
                        <td width="60%">
                            <p><b class="btno"><strong>Специализация:</strong></b> <?= $model->specialityString ?></p>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="40%">
                            <p><b class="btno"><strong>Кол-во страниц:</strong></b> <?= $model->pages ?></p>
                        </td>
                        <td width="60%">
                            <p><b class="btno"><strong>Размер шрифта:</strong></b> <?= $model->font ?></p>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="40%">
                            <p><b class="btno"><strong>Процент на антиплагиате:</strong></b> <?= $model->percent ?></p>
                        </td>
                        <td width="60%">
                            <p><b class="btno"><strong>Дата сдачи:</strong></b> <?= $model->dateEndMedium ?></p>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="40%">
                            <p><b class="btno"><strong>Дополнительные файлы:</strong></b><br>
                                файлов нет</p>
                        </td>
                        <td width="60%">

                        </td>
                    </tr>
                </tbody></table>
            <p>&nbsp;</p>
            <p>предложений: <?= $model->BidCount ?></p>
            <!--<p style="text-align:right;"><a href="">подробнее...</a></p>-->
        </div>
    </blockquote>
</article>
