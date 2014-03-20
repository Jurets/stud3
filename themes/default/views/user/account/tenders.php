<?php 
    //инициализация параметров
    $user = User::model()->findByPk(Yii::app()->user->id);  //найти текущего юзера
    $is_customer = isset($user) && ($user->usertype == User::USERTYPE_CUSTOMER);    //признак юзер=заказчик
?>

<h3>Проекты</h3>
<?php $this->widget('FlashMessages'); ?>

<?php if ($is_customer) { ?>
    <div><a class="btn" href="/"><strong>Опубликовать проект</strong></a></div><br />
<?php } ?>

<?php 
$this->widget('zii.widgets.CListView', 
array(
    'dataProvider' => $dataProvider,
    //'itemView' => 'tenders/_view',
    'itemView' => '../../tenders/default/_view',
    //'itemView' => 'themes/default/views/tenders/default/_view',
    //'itemView' => 'themes.default.views.tenders.default._view',
    //'itemView' => Yii::app()->theme->basePath . '\views\tenders\default\_view.php',
    'ajaxUpdate' => true,
    'emptyText' => '<div class="alert alert-error">Ничего не найдено</div>',
    'template'           => '
        <div class="row-fluid">
        <div class="span6">
        {sorter}
        </div><div class="span6">
        </div>
        </div>
        {items}
        <div class="row-fluid"><div class="span12">
        {pager}</div></div>',
    'sorterCssClass' => 'offers-stateline',
    'sorterHeader' => 'Сортировать по: ',
    'pager'              => array(
        'maxButtonCount' => 8,
        'nextPageLabel'  => 'Следующая',
        'prevPageLabel'  => 'Предыдущая',
        'lastPageLabel'  => 'Последняя',
        'firstPageLabel' => 'Первая',
        
        'header'         => '',
        //'selectedPageCssClass' => 'active',
        //'previousPageCssClass' => '',
        'htmlOptions' => array(
            'class' => '',
            'style' => 'margin:0;'
        )
    ),
    'pagerCssClass' => 'pagination pagination__posts',
    'sortableAttributes'=>array(
        'date' => 'Дате'
    ),
)); ?>
