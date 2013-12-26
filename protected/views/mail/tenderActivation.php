<h3>Здравствуйте<?php if (isset($data->name)) {?>, <?=$data->surname?> <?=$data->name?>. <?php } ?><br/></h3>
<p>Вы подтвердили регистрацию проекта "<?php echo CHtml::encode($tender->title)?>"  на сайте <?=CHtml::encode(Yii::app()->name)?></p>
<p>Желаем успешной работы.</p>
<hr/>
<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>