<div id="yui-main">
<div class="yui-b">

<h1>Купленные товары</h1>

<?php $this->widget('FlashMessages'); ?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'purchased/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
<table class="portfolio">
<tr>
<th class="txtl" style="width: 100px;">Товар</th>
<th style="width: 100px;">Дата покупки</th>
<th style="width: 100px;"></th>
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
		'date' => 'Дате'
	),
));
?>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>