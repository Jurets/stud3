<!--   Вместо этой вьюшки используем общую - \themes\default\views\tenders\default\_view.php   -->

<article class="testimonial clearfix">
    <blockquote class="testimonial_bq">
        <div class="testimonial_content">
            <div class="post_meta meta_type_line">

                <div class="post_author">
                    <i class="icon-user"></i>
                    <a href="../author/alone/index.html" title="Заказчик " rel="author"><?= $data->userdata->nickname ?></a>
                </div>
                <div class="post_date">
                    <i class="icon-calendar"></i>
                    <time datetime="2013-02-14T20:26:57"><?= $data->dateLong ?></time>
                    <!--<time datetime="2013-02-14T20:26:57">Февраль 14, 2013, 12:23</time>-->
                </div>

            </div>

            <h4><?= $data->title ?></h4>

            <p>
                <b class="btno">
                    <strong>Описание:</strong>
                </b> 
                <?= $data->descr ?>
            </p>
            
            <p>&nbsp;</p>
            <table width="100%">
                <tr>
                    <td width="40%">
                        <p><b class="btno"><strong>Тип работы:</strong></b> <?= $data->tendercategory->name ?></p>
                    </td>
                    <td width="60%">
                        <p><b class="btno"><strong>Специализация:</strong></b> <?= $data->specialityString ?></p>
                    </td>
                </tr>
            </table>
            <p>&nbsp;</p>

            <p>предложений: <?= $data->BidCount ?></p>

            <p style="text-align:right;"><a href="/tenders/<?= $data->id ?>.html">подробнее...</a></p>
        </div>
    </blockquote>
</article>