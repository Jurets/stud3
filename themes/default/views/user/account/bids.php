<div id="yui-main">
<div>

<h1>Заявки</h1>


<p class="subtitle">
<strong><a href="/account/bids">Все</a> (<?=$countAll?>)</strong> 
<strong><a href="/account/bids?status=<?=Bids::STATUS_ACTIVE?>">Активные</a> (<?=$countActive?>)</strong> 
<strong><a href="/account/bids?status=<?=Bids::STATUS_ACCEPT?>">Принятые</a> (<?=$countAccepted?>)</strong> 
<strong><a href="/account/bids?status=<?=Bids::STATUS_DECLINE?>">Отлоненные</a> (<?=$countDeclined?>)</strong> 
<strong><a href="/account/bids?status=<?=Bids::STATUS_REJECT?>">Отказался</a> (<?=$countRejected?>)</strong> 
</p>



<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'bids/_view',
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
		'date' => 'Дате',
		'title' => 'Заголовку'
	),
));
?>

</div>
</div>
<!--/yui-main-->

<?php // echo $this->renderPartial('block'); ?>