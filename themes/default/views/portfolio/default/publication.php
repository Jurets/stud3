<h1 class="title">Публикация работы</h1>

<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit' => true,
		'validateOnChange' => true,
		'validateOnType' => false,
	),
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); 
?>
<div class="rnd">
          <table class="order-form">
            <tr>
              <td class="caption"><?php echo $form->labelEx($model, 'title'); ?></td>
              <td class="frnt">
<?php echo $form->textField($model,'title'); ?>
<?php echo $form->error($model,'title'); ?>
              </td>
            </tr>

            <tr>
              <td class="caption"><?php echo $form->labelEx($model, 'category'); ?></td>
              <td class="frnt cat">
<?php echo $form->dropDownList($model, 'category', CHtml::listData($categories, 'id', 'name'), array('empty' => 'Выберите категорию')); ?>
<?php echo $form->error($model,'category'); ?>
              </td>
            </tr>

            <tr>
              <td class="caption"><?php echo $form->labelEx($model, 'text'); ?></td>
              <td class="frnt">
<?php echo $form->textArea($model,'text', array('rows' => 12)); ?>
<?php echo $form->error($model,'text'); ?>
              </td>
            </tr>

            <tr>
              <td class="caption"><?php echo $form->labelEx($model, 'preview'); ?></td>
              <td class="frnt">
<? if( !$model->isNewRecord ): ?>
<img src="<?=Yii::app()->getModule('portfolio')->portfolioDir?><?=$model->preview?>" />
<? endif; ?>
<?php echo CHtml::activeFileField($model, 'preview'); ?>
<?php echo $form->error($model, 'preview'); ?>
              </td>
            </tr>

            <tr>
              <td colspan="2"><?php echo $form->checkBox($model, 'close_comments', array('value' => TRUE, 'uncheckValue' => FALSE)); ?>&nbsp; &nbsp;Запретить комментирование</td>
            </tr>

          </table>
<div class="form-actions">
<button type="submit" class="btn"><?=($model->isNewRecord) ? 'Добавить' : 'Сохранить'?></button>
</div>
</div>

<?php $this->endWidget(); ?>