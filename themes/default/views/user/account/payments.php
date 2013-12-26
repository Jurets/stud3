<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Платежи</h1>

<?php $this->widget('FlashMessages'); ?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'payments/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
{pager}
<br />
<table class="offers">
<tr>
<th style="width:15px;">№</th>
<th style="width:100px;">Дата создания</th>
<th style="width:100px;">Сумма</th>
<th style="width:100px;">Плательщик</th>
<th style="width:100px;">Получатель</th>
<th style="width:60px;">Статус</th>
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
		'amount' => 'Сумме'
	),
));
?>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>