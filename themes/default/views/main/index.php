<?php 
    if (!Yii::app()->user->isGuest)  {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $user_email = $user->email;
    } else {
        $user = null;
        $user_email = '';
    }
?>


<div class="row">
<div class="span12" data-motopress-wrapper-file="page-home.php" data-motopress-wrapper-type="content">
<div class="row">
<div class="span12" data-motopress-type="loop" data-motopress-loop-file="loop/loop-page.php">
<div id="post-203" class="post-203 page type-page status-publish hentry page">
<div class="student-tutor">

    <div class="row-fluid">

        <div class="span6"><img class="alignnone size-full wp-image-1913" alt="student"
                                src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/uploads/2011/09/student.png"
                                width="362" height="350"/>

            <figure class="thumbnail alignnone clearfix">
                <h2>Are you a student?</h2>
                <span class="dropcap">01.</span><!-- .dropcap (end) --><a
                    title="Mauris posuere"
                    href="<?php echo Yii::app()->theme->baseUrl; ?>/uncategorized/mauris-posuere/">Find
                    a tutor in
                    your area</a>

                <div class="clear"></div>
                <!-- .clear (end) -->

                <span class="dropcap">02.</span><!-- .dropcap (end) --><a
                    title="Donec tempor libero"
                    href="<?php echo Yii::app()->theme->baseUrl; ?>/webdesign/donec-tempor-libero/">Contact
                    and arrange lessons
                    with tutors</a>

                <div class="clear"></div>
                <!-- .clear (end) -->

                <span class="dropcap">03.</span><!-- .dropcap (end) --><a
                    title="Etiam dictum egestas"
                    href="<?php echo Yii::app()->theme->baseUrl; ?>/webdesign/etiam-dictum-egestas/">Provide
                    and read tutor
                    feedback</a>

                <div class="clear"></div>
                <!-- .clear (end) -->

            </figure>
        </div>

        <div class="span6"><img class="alignnone size-full wp-image-1914" alt="tutor"
                                src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/uploads/2011/09/tutor.png"
                                width="455" height="322"/>

            <figure class="thumbnail alignnone clearfix">
                <h2>Are you a tutor?</h2>
                <span class="dropcap">01.</span><!-- .dropcap (end) --><a
                    title="Phasellus fringilla"
                    href="<?php echo Yii::app()->theme->baseUrl; ?>/css3/phasellus-fringilla/">Create
                    your own tutor profile
                    for free</a>

                <div class="clear"></div>
                <!-- .clear (end) -->

                <span class="dropcap">02.</span><!-- .dropcap (end) --><a
                    title="Vivamus vel sem at"
                    href="<?php echo Yii::app()->theme->baseUrl; ?>/css3/vivamus-vel-sem-at/">Allow
                    students to find you
                    by postcode</a>

                <div class="clear"></div>
                <!-- .clear (end) -->

                <span class="dropcap">03.</span><!-- .dropcap (end) --><a
                    title="Etiam commodo convallis"
                    href="<?php echo Yii::app()->theme->baseUrl; ?>/html5/etiam-commodo-convallis/">List
                    all your subjects and set
                    your own prices</a>

                <div class="clear"></div>
                <!-- .clear (end) -->

            </figure>
        </div>

    </div>
    <!-- .row-fluid (end) -->

    <div class="steps-to-start-dark"></div>

</div>
<div class="steps-to-start">
    <div class="steps-to-start-light"></div>
    <div class="row">

        <div class="span4"><h1>steps to start:</h1></div>

        <div class="span6">
            <div class="row-fluid">

                <div class="span4">
                    <div class="service-box stepstostart">
                        <figure class="icon"><img
                                src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/images/icon1.png"
                                alt=""/></figure>
                        <div class="service-box_body"><h2 class="title"><a
                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/uncategorized/mauris-posuere/">search
                                    &amp; review</a></h2></div>
                    </div>
                    <!-- /Service Box --></div>

                <div class="span4">
                    <div class="service-box stepstostart">
                        <figure class="icon"><img
                                src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/images/icon2.png"
                                alt=""/></figure>
                        <div class="service-box_body"><h2 class="title"><a
                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/webdesign/donec-tempor-libero/">contact
                                    tutors</a></h2></div>
                    </div>
                    <!-- /Service Box --></div>

                <div class="span4">
                    <div class="service-box stepstostart">
                        <figure class="icon"><img
                                src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/images/icon3.png"
                                alt=""/></figure>
                        <div class="service-box_body"><h2 class="title"><a
                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/webdesign/etiam-dictum-egestas/">schedule
                                    lessons</a></h2></div>
                    </div>
                    <!-- /Service Box --></div>

            </div>
            <!-- .row-fluid (end) --></div>

        <div class="span2"><a href="<?php echo Yii::app()->theme->baseUrl; ?>/portfolio/"
                              title="learn more"
                              class="btn btn-default btn-large btn-inline steps-btn"
                              target="_self">learn more</a><!-- .btn --></div>

    </div>
    <!-- .row (end) -->

</div>
<div class="row">

    <div class="span6">
        <h3>Оценка стоимости работы</h3>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'enableClientValidation' => true,
            'enableAjaxValidation'   => true,
            'errorMessageCssClass'   => 'none',
            'clientOptions'          => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType'   => false,
                'afterValidate'    => 'js:function(form, data, hasError){
			string = "";
			$.each(data, function(index, value)
			{
				if(index != "__proto")
				{
					var temp = data[index][0];
					string += "<li>"+temp+"</li>";
				}
			});
			if(hasError) messages(\'error\', string);
			if(!hasError) return true;
		}'
            ),
        ));
        ?>
        <?php /* @var $form CActiveForm */ ?>
        <?php echo $form->error($model, 'category'); ?>
        <?php echo $form->error($model, 'title'); ?>
        <?php echo $form->error($model, 'text'); ?>
        <?php echo $form->error($model, 'budget'); ?>
        <?php //echo $form->error($rmodel, 'username'); ?>
        <?php echo $form->error($rmodel, 'email'); ?>
        <?php echo $form->error($rmodel, 'captcha'); ?>

        <div class="row-fluid">
            <?php echo $form->label($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('class' => 'inp_text row-fluid', 'placeholder' => 'Пример: нужен диплом по философии или убийца')); ?>
        </div>
        <div class="row-fluid">
            <?php echo $form->label($model, 'text'); ?>
            <?php echo $form->textArea($model, 'text', array('class' => 'area row-fluid', 'placeholder' => 'Пример описания заказа', 'rows' => 10)); ?>
        </div>
        <div class="row-fluid">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $form->label($model, 'category'); ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $form->dropDownList($model, 'category', CHtml::listData($categories, 'id', 'name'), array('empty' => 'Выберите тип:'), array()); ?>
                    </div>
                </div>
            </div>
            <div class="span8">
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $form->label($rmodel, 'email'); ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $form->textField($rmodel, 'email', array(
                            'value' => $user_email,
                            'class' => 'inp_text row-fluid', 
                            'placeholder' => 'example@axample.com'
                            )); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <?php echo CHtml::submitButton('Оценить', array('class' => 'green-submit')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

    <div class="span6">
        <h3>Лента заказов</h3>
        <? foreach ($projects as $data): ?>

            <div class="span12"><h2><?= $data->title ?></h2>

                <div class="testimonials ">
                    <div class="testi-item">
                        <blockquote class="testi-item_blockquote">
                            <div class="clear"></div>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/tenders/<?= $data->id ?>.html"><?= $data->descr ?>
                                &nbsp;</a>
                        </blockquote>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
<!-- .row (end) -->
<div class="clear"></div>
<!--.pagination-->
</div>
<!--#post-->
</div>
</div>
</div>
</div>


            <!--<div id="auth" style="width: auto; height: auto; position: absolute; z-index: 999; margin-left: 600px;">-->
            <div id="auth" style="width: auto; height: auto; z-index: 999; margin-left: 600px;">
                <?php 
                if (isset($user))  {
                ?>
                    <p>Пользователь: <?= $user->username?></p>
                    <a class="green-submit" href="<?= Yii::app()->createAbsoluteUrl('logout') ?>">Выход</a>
                <? } else { ?>
                    <a class="green-submit" href="<?= Yii::app()->createAbsoluteUrl('login') ?>">Вход</a>
                <?php } ?>
            </div>        
