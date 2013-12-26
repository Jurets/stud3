<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1 class="market-title">Контакты</h1>



<div class="lighter">

<form action="/search" method="get">
<span><span class="grey">Найти контакт</span> 
<?
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
     'name'=>'keywords',
     'source'=>'/user/account/juiList',
     'options'=>array(
	 'minLength' => 1,
          'html'=>true,
          'select'=>'js: function(event,ui){$("#data").val(ui.item.name); document.location.href = "/users/" + ui.item.name + ""; return false;}',
     ),
        'htmlOptions'=>array(
				'class'=>'search square'
        ),
));
?>
</span>
</form>

</div>

<br />
<ul class="nav nav-tabs txt-small">
<li<? if( !$specialization ): ?> class="active"<? endif; ?>><a href="/account/contacts">Все</a></li>
<li<? if( $specialization == User::SPECIALIZATION_DEVELOPER ): ?> class="active"<? endif; ?>><a href="/account/contacts?specialization=<?=User::SPECIALIZATION_DEVELOPER?>">Разработчики</a></li>
<li<? if( $specialization == User::SPECIALIZATION_DESIGNER ): ?> class="active"<? endif; ?>><a href="/account/contacts?specialization=<?=User::SPECIALIZATION_DESIGNER?>">Дизайнеры</a></li>
<li<? if( $specialization == User::SPECIALIZATION_COPYWRITER ): ?> class="active"<? endif; ?>><a href="/account/contacts?specialization=<?=User::SPECIALIZATION_COPYWRITER?>">Копирайтеры</a></li> 
<li<? if( $specialization == User::SPECIALIZATION_SYSTEM ): ?> class="active"<? endif; ?>><a href="/account/contacts?specialization=<?=User::SPECIALIZATION_SYSTEM?>">Системные администраторы</a></li>
<li<? if( $specialization == User::SPECIALIZATION_MANAGER ): ?> class="active"<? endif; ?>><a href="/account/contacts?specialization=<?=User::SPECIALIZATION_MANAGER?>">Менеджеры</a></li>
<li<? if( $specialization == User::SPECIALIZATION_INVESTOR ): ?> class="active"<? endif; ?>><a href="/account/contacts?specialization=<?=User::SPECIALIZATION_INVESTOR?>">Инвесторы</a></li> 
</ul>
<br />

<?php 
$this->widget('zii.widgets.CListView', 
array(
	'dataProvider' => $dataProvider,
	'itemView' => 'friends/_view',
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