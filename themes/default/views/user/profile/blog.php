<?php echo $this->renderPartial('head', $data); ?>

<div id="yui-main">
<div id="usermain" class="yui-b">

<? if( $data->id == Yii::app()->user->id ): ?>
<div><a class="btn" href="/blogs/add">Добавить запись</a></div><br />
<? endif ;?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'blog/_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template' => "{sorter}{items}<br />{pager}", 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header' => '',
	),
	'sortableAttributes'=>array(
		'date' => 'Дате',
		'title' => 'Заголовку',
		'like' => 'Популярности'
	),
));
?>

<br clear="all" />

</div>
</div>

<?php echo $this->renderPartial('profile', $data); ?>