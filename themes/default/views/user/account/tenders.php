<div id="yui-main">
<div>

<h1 class="market-title">Проекты</h1>

<p class="subtitle">
<strong><a href="/account/tenders">Все</a> (<?=$countAll?>)</strong> 
<strong><a href="/account/tenders?status=<?=Tenders::STATUS_OPEN?>">Открытые </a> (<?=$countOpened?>)</strong> 
<strong><a href="/account/tenders?status=<?=Tenders::STATUS_CLOSE?>">Закрытые</a> (<?=$countClosed?>)</strong>
</p>

<div><a class="btn" href="/tenders/publication"><strong>Опубликовать проект</strong></a></div><br />

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'tenders/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
<table class="listorder">
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

<?php // echo $this->renderPartial('block'); ?>