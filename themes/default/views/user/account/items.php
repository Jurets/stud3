<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Товары</h1>

<?php $this->widget('FlashMessages'); ?>

<div><a class="btn" href="/items/publication">Добавить</a></div><br />

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'items/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
<table class="portfolio">
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
		'title' => 'Заголовку'
	),
));
?>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>