<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">Гости</h1>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'guests/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>"{sorter}\n<div class='following'>{items}</div>\n<br />{pager}", 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'summaryText' => '{start}-{end} из {count} найденых',
	'pager' => array(
		'header'=>'',
	),
	'sortableAttributes'=>array(
		'update'=>'Дате визита',
		'guestdata.username'=>'Имени',
	),
));
?>



  
  </div>

</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>