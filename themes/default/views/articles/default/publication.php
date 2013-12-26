<h1 class="title"><?=($model->isNewRecord) ? 'Добавить статью' : 'Редактировать статью'?></h1>

<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
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
              <td class="caption"><?php echo $form->labelEx($model, 'short_text'); ?></td>
              <td class="frnt">
<?php echo $form->textArea($model,'short_text', array('rows' => 12)); ?>
<?php echo $form->error($model,'short_text'); ?>
              </td>
            </tr>

            <tr>
              <td class="caption"><?php echo $form->labelEx($model, 'text'); ?></td>
              <td class="frnt">
<?php $this->widget('EMarkitupWidget',array('attribute' => 'text', 'model' => $model));?>
<?php echo $form->error($model,'text'); ?>
              </td>
            </tr>

<tr>
<td class="caption">Тэги:</td>
<td class="frnt">
<?php   $this->widget('application.extensions.tag.TagWidget', array(
			'url'=> '/articles/default/json',
			'tags' => $model->getTags()
        ));
       ?>
</td>
</tr>

            <tr>
              <td class="caption"><?php echo $form->labelEx($model, 'preview'); ?></td>
              <td class="frnt cat">
<? if( !$model->isNewRecord ): ?>
<img src="<?=Yii::app()->getModule('articles')->articlesDir?><?=$model->preview?>" width="100" />
<? endif; ?>
<div>
<?php echo CHtml::activeFileField($model, 'preview'); ?>
</div>
<span id="text">Картинка: 100х100px, gif, jpg, jpeg, png</span>
<?php echo $form->error($model, 'preview'); ?>

              </td>
            </tr>

          </table>

<div class="form-actions">
<button type="submit" class="btn"><?=($model->isNewRecord) ? 'Добавить' : 'Сохранить'?></button>
</div>

</div>
<?php $this->endWidget(); ?>