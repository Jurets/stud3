<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Приглашения</h1>

<ul class="nav nav-pills">
  <li><a href="/account/invitations">Приглашения</a></li>
  <li class="active"><a href="/account/myinvitations">Мои приглашения</a></li>
</ul>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'myinvitations/_view',
	'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>'
<table class="contractors">
{items}
</table>
<br />
{pager}
',
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'summaryText' => '{start}-{end} из {count} найденых',
	'pager' => array(
		'header'=>'',
	),
	'sortableAttributes'=>array(
		'date'=>'Дате',
		'userdata.username'=>'Имени',
	),
));
?>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>