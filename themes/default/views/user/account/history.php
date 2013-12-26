<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>История операций</h1>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'history/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
<table class="offers">
<tr>
<th style="width:150px;">Дата</th>
<th style="width:150px;">Сумма</th>
<th>Описание</th>
</tr>
{items}
</table>
<br />
{pager}', 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header'=>'',
	),
	'sortableAttributes'=>array(
		'date' => 'Дате',
		'amount' => 'Сумме',
		'descr' => 'Описанию'
	),
));
?>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>