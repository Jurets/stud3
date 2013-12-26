<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">Подписан</h1>

<ul class="nav nav-pills">
  <li<? if( !$_GET['online'] ): ?> class="active"<? endif; ?>><a href="/account/favorites">Все</a></li>
  <li<? if( $_GET['online'] ): ?> class="active"<? endif; ?>><a href="/account/favorites?online=1">На сайте</a></li>
</ul>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'favorites/_view',
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
		'date'=>'Дате',
		'favoritedata.username'=>'Имени',
	),
));
?>



  
  </div>

</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>