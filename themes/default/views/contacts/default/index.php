<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">Мои сообщения<? if( $group->name ): ?> / <?=$group->name?><? endif; ?></h1>

<div>

<?php $this->widget('FlashMessages'); ?>

</div>

<?php $form = $this->beginWidget('CActiveForm', array('action' => '/contacts/default/move')); ?>
<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'contacts/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
<table class="contractors">

{items}
</table>
{pager}
', 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header' => '',
	),
	'sortableAttributes'=>array(
		'last_msg' => 'Последнему сообщению',
		'messages' => 'Количеству сообщений',
		'userdata.username' => 'Пользователю',
	),
));
?>

<div id="msearch">
Переместить отмеченные в: 
<div>
<select name="group_id">
<option value="0">Все</option>
<? foreach($groups as $row): ?> 
<option value="<?=$row['id']?>"><?=$row['name']?></option>
<? endforeach; ?>
</select>
</div>
<div class="form-actions">
<button type="submit" class="btn">Переместить</button>
</div>
</div>

<?php $this->endWidget(); ?>

</div>
</div>
<!--/yui-main-->


<!--Блок-->
<div class="yui-b">
<div class="bd">
<div id="accsidebar">


<div id="rightCol">

<div id="content">

<div class="box first">
<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation' => true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => true,
	),
)); 
?>
<?php echo $form->textField($modelg,'name'); ?>

<button type="submit" class="btn"><i class="icon-plus icon-black"></i></button>

<?php echo $form->error($modelg,'name'); ?>

<?php $this->endWidget(); ?>	
</div>

<ul>
<li class="last"><a href="/contacts" class="blue">Все</a></li>
<li class="last"><a href="/contacts/?message=new" class="blue">Непрочитанные</a></li>
<li class="last"><a href="/contacts/?group_id=<?=Groups::GROUP_BLACKLIST?>" class="blue">Игнорирую</a></li>
</ul>

<? if( $groups ): ?> 
<ul class="custom">
<? foreach($groups as $row): ?> 
<li id="li_folder<?=$row['id']?>">
<i class="icon-folder-open"></i> 
<a href="/contacts/?group_id=<?=$row['id']?>" class="blue"><span id="fldname<?=$row['id']?>"><?=$row['name']?></span></a> (<span id="fldcount<?=$row['id']?>"><?=$row['countContacts']?></span>)
<div align="right"><a href="/contacts/groups/delete/?id=<?=$row['id']?>">Удалить</a> | <a href='javascript: rename("<?=$row['id']?>","0", "<?=$row['name']?>","0");'>Переименовать</a></div>
<? endforeach; ?>
</ul>
<? endif; ?>
			
</div>

</div>


</div>
</div>
</div>
<!--/Блок-->