<div id="yui-main">
<div class="yui-b">

<table class="contractors">
<td class="text">
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$model->userpic?>" alt="" class="avatar" width="70" />
<ul class="ucard">
<li class="utitle"><a class="black" href="/users/<?=$model->username?>"><?=$model->name?> <?=$model->surname?> (<?=$model->username?>)</a></li>

<? if( $contact ): ?>
<li><a href="/contacts/send/<?=$model->username?>">Сообщений</a> (<?=$contact->messages?>)</li>
<li>Последнее сообщение: <?=Date_helper::date_smart($contact->last_msg)?></li>
<? endif; ?>

</ul>
</td>
</table>
    
<? if( $black ): ?>
<div class="alert alert-error">Пользователь отключил переписку</div>
<? else: ?>

<?php $form = $this->beginWidget('CActiveForm', array(
'action' => '',
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); 
?>
<div class="comments-form">
<div>
<?php echo $form->textArea($comment, 'text', array('rows' => 7, 'cols' => 60)); ?>
<?php echo $form->error($comment, 'text'); ?>
</div>



<div>
<?php
$this->widget('CMultiFileUpload', array(
                'name' => 'attachments',
				'max' => 5,
                'accept' => 'ai|avi|doc|docx|flv|gif|gz|html|jpeg|jpg|pdf|png|psd|rar|rtf|swf|tar|txt|xls|xslx|zip',
                'duplicate' => 'Duplicate file!',
                'denied' => 'Invalid file type',
            ));     
?>
</div>

<div>
Типы файлов: ai, avi, doc, docx, flv, gif, gz, html, jpeg, jpg, pdf, png, psd, rar, rtf, swf, tar, txt, xls, xslx, zip
</div>

<div class="form-actions">
<button type="submit" class="btn">Отправить</button>
</div>
</div>
<?php $this->endWidget(); ?>
<? endif; ?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'messages/_view',
	'ajaxUpdate' => true,
    'emptyText' => 'Ничего не найдено',
	'template' => '
{sorter}
{items}
{pager}
', 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header' => '',
	),
	'sortableAttributes'=>array(
		'date' => 'Дате'
	),
));
?>

</div>
</div>
<!--/yui-main-->

<!--Блок-->
<div id="sidebar" class="yui-b">



<img src="/images/240x400.jpg" />



</div>
<!--/Блок-->