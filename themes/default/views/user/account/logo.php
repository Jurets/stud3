<div id="yui-main">
<div class="yui-b">

<h1>Логотип</h1>

<?php $this->widget('FlashMessages'); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'errorMessageCssClass' => 'alert alert-error',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<table class="images">
<tr>
<td width="200">
<? if( $model->logo ): ?>
<img src="<?=Yii::app()->getModule('user')->logoDir?><?=$model->logo?>" alt=""><br>
<ul class="nav nav-list">
<li><a href="/user/account/deletelogo"><i class="icon-remove"></i> Удалить</a></li>
</ul>
<br />
<? endif; ?>
Загрузить логотип<br />
<?php echo CHtml::activeFileField($model, 'logo'); ?>
<?php echo $form->error($model,'logo'); ?>
</td>
</tr>         
</table>

<br>
<div class="form-actions">
<button type="submit" class="btn">Загрузить</button>
</div>


          
<?php $this->endWidget(); ?>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>