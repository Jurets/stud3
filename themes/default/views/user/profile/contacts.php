<?php echo $this->renderPartial('head', $data); ?>

<div id="yui-main">
<div id="usermain" class="yui-b">

<?php
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'contacts/_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>"{sorter}\n<div class='following'>{items}</div>\n<br />{pager}", 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'summaryText' => '{start}-{end} из {count} найденых',
	'pager' => array(
		'header'=>'',
	),
	'sortableAttributes'=>array(
		'date'=>'Дате',
		'frienddata.username'=>'Имени',
	),
));
?>

<br clear="all" />

</div>
</div>


<?php echo $this->renderPartial('profile', $data); ?>