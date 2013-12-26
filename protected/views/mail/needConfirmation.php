<? $url = Yii::app()->params['site'].'/confirmation?code='.$data->hash; ?>

Здравствуйте.<br/>
<br/>
Для активации проекта с темой "<?php echo CHtml::encode($data->title) ;?>", пожалуйста, перейдите по ссылке:<br />
<br />
<a target="_blank" href="<?=$url?>"><?=$url?></a>
<br/>

Код активации: <?=$data->hash?>
<br/>
Ссылка на ваш заказ: <a target="_blank" href="<?=Yii::app()->params['site']?>/tenders/<?=$data->tender_id?>.html">перейти</a>

<p>С уважением, <br/>
администрация сайта <br/>
<a target="_blank" href="<?=Yii::app()->params['site']?>"><?=CHtml::encode(Yii::app()->name)?></a></p>