		<div id="container">
			<div id="content">
<h1>Фотография</h1>

<?php $this->widget('FlashMessages'); ?>

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

		<div class="sidebar" id="sideLeft">
<?php echo $this->renderPartial('block'); ?>
			
            
		</div><!-- .sidebar#sideLeft -->