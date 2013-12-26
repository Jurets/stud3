<?php echo $this->renderPartial('head', $data); ?>

<div id="yui-main">
<div id="usermain" class="yui-b">

<? if( $data->id == Yii::app()->user->id ): ?>
<div><a class="btn" href="/portfolio/publication">Добавить работу</a></div><br />
<? endif ;?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'portfolio/_view',
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

<br clear="all" />

</div>
</div>


<?php echo $this->renderPartial('profile', $data); ?>