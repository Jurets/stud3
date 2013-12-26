<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

      <div class="yui-gc">
<?php $form = $this->beginWidget('CActiveForm', array())?>
         <div class="yui-u first">
<table class="tariffs">
<tr>
<th class="txtl" width="200px">Составляющие рейтинга</th>
<th>Действия</th>
<th>Множитель</th>
</tr>

<tr>
<td class="title"><?php echo $form->labelEx($model, 'items'); ?></td>
<td class="budget txtc"><?=$data->items?></td>
<td class="budget txtc red">x <?=$model->getValue('items')?></td>
</tr>

<tr>
<td class="title"><?php echo $form->labelEx($model, 'portfolio'); ?></td>
<td class="budget txtc"><?=$data->portfolio?></td>
<td class="budget txtc red">x <?=$model->getValue('portfolio')?></td>
</tr>

<tr>
<td class="title"><?php echo $form->labelEx($model, 'recdposreview'); ?></td>
<td class="budget txtc"><?=$data->recdposreview?></td>
<td class="budget txtc red">x <?=$model->getValue('recdposreview')?></td>
</tr>

<tr>
<td class="title"><?php echo $form->labelEx($model, 'recdnegreview'); ?></td>
<td class="budget txtc red"><?=$data->recdnegreview?></td>
<td class="budget txtc red">x <?=$model->getValue('recdnegreview')?></td>
</tr>

<tr>
<td class="title"><?php echo $form->labelEx($model, 'purchased'); ?></td>
<td class="budget txtc"><?=$data->purchased?></td>
<td class="budget txtc red">x <?=$model->getValue('purchased')?></td>
</tr>

</table>

         </div>
<?php $this->endWidget(); ?>
         <div class="yui-u">
<strong>Общий рейтинг: <?=$user->rating?></strong>
         </div>
      </div>
     

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>