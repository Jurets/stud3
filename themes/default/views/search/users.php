<div id="yui-main">
<div class="clearfix"> 

<h1 class="title">Поиск по сайту</h1>


<div class="form-actions">

<div class="lighter">
	<form action="/search" method="get">
    <input type="hidden" name="type" value="users" />
		<span><input type="text" name="keywords" class="search square" style="width:500px;" placeholder="Скрипт интернет магазина" value="<?=$keywords?>"><button type="submit" class="btn">Поиск</button>
</span>
	</form>
</div>
<a href="/search/?type=projects" class="btn btn-small">Найти проекты</a> 
<a href="/search/?type=items" class="btn btn-small">Найти готовые работы</a> 
<a href="/search/?type=users" class="btn btn-small active">Найти пользователей</a>         
</div>

<? if( !$keywords ): ?>

<div class="alert alert-info">Введите ключевое слово, не менее 2 символов</div>

<? else: ?>
<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => '_viewuser',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>'
{sorter}
<table class="contractors">
<tr>
<td class="topline txtl title">Пользователь</td>
<td class="topline" style="width: 50px;">Рейтинг</td>
<td class="topline" style="width: 50px;">Товары</td>
<td class="topline" style="width: 50px;">Отзывы</td>
<td class="topline" style="width: 50px;">Портфолио</td>
<td class="topline" style="width: 50px;">Подписчики</td>
</tr>
{items}
</table>
<br />
{pager}
', 
	'sorterCssClass' => 'offers-stateline',
	'sorterHeader' => 'Сортировать по: ',
	'pager' => array(
		'header'=>'',
	),
	'sortableAttributes'=>array(
		'rating'=>'Рейтингу',
		'static.reviews_positive'=>'Отзывам',
	),
));
?>

<? endif; ?>

</div>
</div>