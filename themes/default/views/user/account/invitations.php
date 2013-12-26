<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">Приглашения</h1>

<?php $this->widget('FlashMessages'); ?>

<ul class="nav nav-pills">
  <li class="active"><a href="/account/invitations">Приглашения</a></li>
  <li><a href="/account/myinvitations">Мои приглашения</a></li>
</ul>

<p class="subtitle">Вашим контактам будут доступны все ваши контактные данные, включая электронный адрес</p>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'invitations/_view',
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