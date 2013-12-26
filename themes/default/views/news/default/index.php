<div id="yui-main">
<div class="yui-b clearfix"> 

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template' => "{sorter}{items}<br />{pager}", 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header' => '',
	),
	'sortableAttributes'=>array(
		'date' => 'Дате'
	),
));
?>

</div>
</div>

    
<div id="sidebar" class="yui-b">
<div class="bd clearfix box">

<img src="/images/banner2.gif" />
<br /><br /><br />
<img src="/images/banner2.gif" />

</div>
</div>