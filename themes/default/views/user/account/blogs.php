<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Записи</h1>

<div><a class="btn" href="/blogs/publication">Добавить</a></div><br />

<?php $this->widget('FlashMessages'); ?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'blogs/_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>"{sorter}\n<table class=\"listorder\">{items}</table>\n<br />{pager}", 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header'=>'',
	),
	'sortableAttributes'=>array(
		'date'=>'Дате',
		'title'=>'Заголовку'
	),
));
?>


  
</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>