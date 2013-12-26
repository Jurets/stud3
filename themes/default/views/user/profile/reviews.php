<?php echo $this->renderPartial('head', $data); ?>

<div id="yui-main">
<div id="usermain" class="yui-b">

<?php $this->widget('FlashMessages'); ?>

<? if( $data->id != Yii::app()->user->id ): ?>
<div><button class="btn" onClick="parent.location='/users/addreview/<?=$data->username?>'">Добавить отзыв</button></div><br />
<? endif ;?>

<?php
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'reviews/_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>'
{sorter}
<div id="reviews" class="clearfix">
<table class="reviews">
<tr>
<th class="txtl">Пользователь</th>
<th style="width:70px;">Оценка</th>
</tr>
{items}
</table>
</div>
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
		'mark'=>'Оценке',
	),
));
?>

<br clear="all" />

</div>
</div>


<?php echo $this->renderPartial('profile', $data); ?>