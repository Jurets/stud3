		<div id="container">
			<div id="content">

				
<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template' => "{sorter}<br /><div class=\"prep\">{items}</div><br />{pager}", 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header' => '',
	),
	'sortableAttributes'=>array(
		'date' => 'Дате',
		'views' => 'Просмотрам',
		'comments' => 'Комментариям'
	),
));
?>


			</div><!-- #content-->
		</div><!-- #container-->


		<div class="sidebar" id="sideLeft">
<? $this->widget('MenuWidget') ?>
			

            
		</div><!-- .sidebar#sideLeft -->
        



