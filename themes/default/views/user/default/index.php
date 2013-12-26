<div id="yui-main">
<div class="yui-b clearfix"> 

<h1 class="market-title">Все пользователи</h1>



<?php if( Yii::app()->user->isAuthenticated() ): ?>
<div class="txt-smalldel">

<?php $form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
)); 
?>

<div>
<? if( $search->status == UsersSearch::STATUS_ON ): ?>
<a href="/users?action=delete" class="btn btn-mini"><i class="icon-filter"></i> Отключить фильтр</a>
<? else: ?>
<a href="/users?action=apply" class="btn btn-mini"><i class="icon-filter"></i> Включить фильтр</a>
<? endif; ?>
</div>

<table class="setting">
<tr>
<td class="caption" style="width:100px; border:none;">Ключевые слова:</td>
<td style="border:none;">
<?php echo $form->textField($search, 'keywords', array('style' => 'width:400px')); ?>
</td>
</tr>

<tr>
<td class="caption" style="width:100px; border:none;">Имя или логин:</td>
<td style="border:none;">
<?php echo $form->textField($search, 'username', array('class' => 'span3')); ?>
</td>
</tr>

<tr>
<td class="caption" style="width:100px; border:none;"></td>
<td style="border:none;">
              <label class="checkbox">
<?php echo $form->checkBox($search, 'favorite'); ?>
                У меня в избранном
              </label>
              <label class="checkbox">
<?php echo $form->checkBox($search, 'reviews'); ?>
                С отзывами
              </label>
              <label class="checkbox">
<?php echo $form->checkBox($search, 'portfolio'); ?>
                С примерами работ
              </label>
</td>
</tr>

<tr>
<td class="caption" style="width:100px; border:none;">По навыкам</td>
<td style="border:none;">
<?php
$this->widget('application.extensions.tag.TagWidget', array(
	'url'=> '/user/account/json',
	'tags' => $interests,
));
?>

</td>
</tr>

</table>

<div class="form-actions">
<button type="submit" class="btn">Применить фильтр</button>
</div>

<?php $this->endWidget(); ?>

</div>
<?php endif; ?>

<br />


<ul class="nav nav-tabs txt-small">
<li<? if( !$specialization ): ?> class="active"<? endif; ?>><a href="/users">Все</a></li>
<li<? if( $specialization == User::SPECIALIZATION_DEVELOPER ): ?> class="active"<? endif; ?>><a href="/users?specialization=<?=User::SPECIALIZATION_DEVELOPER?>">Разработчики</a></li>
<li<? if( $specialization == User::SPECIALIZATION_DESIGNER ): ?> class="active"<? endif; ?>><a href="/users?specialization=<?=User::SPECIALIZATION_DESIGNER?>">Дизайнеры</a></li>
<li<? if( $specialization == User::SPECIALIZATION_COPYWRITER ): ?> class="active"<? endif; ?>><a href="/users?specialization=<?=User::SPECIALIZATION_COPYWRITER?>">Копирайтеры</a></li> 
<li<? if( $specialization == User::SPECIALIZATION_SYSTEM ): ?> class="active"<? endif; ?>><a href="/users?specialization=<?=User::SPECIALIZATION_SYSTEM?>">Системные администраторы</a></li>
<li<? if( $specialization == User::SPECIALIZATION_MANAGER ): ?> class="active"<? endif; ?>><a href="/users?specialization=<?=User::SPECIALIZATION_MANAGER?>">Менеджеры</a></li>
<li<? if( $specialization == User::SPECIALIZATION_INVESTOR ): ?> class="active"<? endif; ?>><a href="/users?specialization=<?=User::SPECIALIZATION_INVESTOR?>">Инвесторы</a></li> 
</ul>

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
	'ajaxUpdate' => true,
    'emptyText'=>'<div class="alert alert-error">Ничего не найдено</div>',
	'template'=>'
{sorter}
<table class="contractors">
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


<? 
/*
echo $dataProvider->getSort()->link('rating', 'rating');


$pagination = $this->widget('CLinkPager', array('pages' =>$dataProvider->getPagination()), true);

echo $pagination;
*/
?>
</div>
</div>



<div id="sidebar" class="yui-b">
<div class="bd clearfix">


        
<div class="sideblock">


<h3>Каталог пользователей</h3>
<div class="main">
<?
$categories = Categories::getCategories();
?>
            <ul id="menu">
<? foreach ($categories[0] as $CatId => $CatName ): ?>
            	<li class="drop-bt<? if( $CatId == $category->parent_id ): ?> current<? endif; ?>"><a href="#"><?=$CatName?></a></li>
<ul class="drop-menu"<? if( $CatId == $category->parent_id ): ?> style="display:block"<? endif; ?>>
<? foreach ($categories[$CatId] as $ItemId => $ItemName): ?>
				
				<li class="second"><a href="/users?category=<?=$ItemId?>" class="second"><?=$ItemName?></a></li>

<? endforeach; ?>
</ul>
                
                
<? endforeach; ?>

            </ul>
</div>

</div>

</div>
</div>
<style type="text/css">
ul#menu .drop-menu:nth-of-type(1)
{
 display:block;
} 
</style>
<script type="text/javascript">
	$('ul#menu li.drop-bt:first').addClass('current');
</script>