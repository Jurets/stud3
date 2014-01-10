<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="page-testi.php" data-motopress-wrapper-type="content">
                
                <? // вьюшка хедера кабинета (повторяется на разных страницах кабинета)
                   //$this->renderPartial('head', array('model' => $model)) 
                   $this->widget('HeaderWidget');
                   ?>
                
                <div class="row">
                    <div class="span8">
                        <h3>Новости системы</h3>

                        <div class="post_meta meta_type_line">
                            <div class="post_date">
                                <i class="icon-calendar"></i>
                                <time datetime="">Февраль 14, 2013, 12:23</time>
                            </div>                    
                        </div>

                        <p><span style="color: #127a5e;"><strong>
                                Обновили вопросы / ответы
                            </strong></span><br />
                        <p>
                            Раз в месяц мы выкладываем новые вопросы, которые Вы присылаете в нашу поддержку и ответы на них. Сегодня дбавилось 20 вопросов. Самым актуальным оказался пополнения через киви
                        </p>
                        <div class="clear"></div><!-- .clear (end) -->
                        <a href="../portfolio/index.html" title="read more" class="btn btn-default btn-normal btn-inline " target="_self">Читать подробнее</a><!-- .btn -->

                        <p>&nbsp;</p>
                        <p>&nbsp;</p>

                        <div class="post_meta meta_type_line">
                            <div class="post_date">
                                <i class="icon-calendar"></i>
                                <time datetime="">Февраль 10, 2013, 12:00</time>
                            </div>                    
                        </div>

                        <p><span style="color: #127a5e;"><strong>
                                Вывод средств по заявкам до 01 февраля
                            </strong></span><br />
                        <p>
                            По всем заявкам вывода средств поступившим до 01 февраля были произведены выплаты. Если вы создавали заявку и не получили выплату просьба обратиться в техническую поддержку.
                        </p>
                        <div class="clear"></div><!-- .clear (end) -->
                        <a href="../portfolio/index.html" title="read more" class="btn btn-default btn-normal btn-inline " target="_self">Читать подробнее</a><!-- .btn -->

                    </div>
                    
                    <? $this->widget('MenuWidget'); //правый сайд бар - менюшка (повторяется на страницах кабинета) ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--End #motopress-main-->