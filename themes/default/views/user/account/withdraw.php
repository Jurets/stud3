<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Вывод средств</h1>

<?php $this->widget('FlashMessages'); ?>

<div><a class="btn" href="/account/addwithdraw">Вывести</a></div><br />

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'withdraw/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
<table class="portfolio">
<tr>
<th class="txtl" style="width: 100px;">Дата</th>
<th style="width: 100px;">Сумма</th>
<th style="width: 100px;">Кошелёк</th>
<th style="width: 60px;">Статус</th>
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