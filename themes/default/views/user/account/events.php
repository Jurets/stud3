<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">События</h1>

<p class="subtitle">
<a href="/account/events">Все</a> &nbsp; 
<a href="/account/events?type=<?=Events::TYPE_INVITE?>">Приглашения</a> &nbsp; 
<a href="/account/events?type=<?=Events::TYPE_MESSAGES?>">Личные сообщения</a> &nbsp; 
<a href="/account/events?type=<?=Events::TYPE_PROJECTS?>">Удаленная работа</a> &nbsp; 
<a href="/account/events?type=<?=Events::TYPE_ITEMS?>">Каталог готовых работ</a> &nbsp; 
<a href="/account/events?type=<?=Events::TYPE_BLOGS?>">Блоги</a> &nbsp; 
</p>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'events/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template' => '
{sorter}
{pager}
<br />
<table class="offers">

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