		    	<h5 class="widget-name"><i class="icon-th"></i>Товары</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Список товаров</h6>
                        </div>
                    </div>
                    <div class="table-overflow">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Превью</th>
                                    <th>Заголовок</th>
                                    <th>Категория</th>
                                    <th>Дата добавления</th>
                                    <th>Статус</th>
                                    <th class="actions-column">Управление</th>
                                </tr>
                            </thead>
                            <tbody>
<? foreach($list as $row): ?>
                                <tr>
			                        <td><a href="#" title="" class="lightbox"><img src="<?php echo Yii::app()->getModule('items')->itemsDir.$row->thumbnail?>" alt="" /></a></td>
			                        <td><a href="#" title=""><?php echo $row->title; ?></a></td>
			                        <td><a href="#" title=""><?php echo $row->Category(); ?></a></td>
			                        <td><?php echo $row->date(); ?></td>
			                        <td><?php echo $row->getStatus(); ?></td>
			                        <td>
		                                <ul class="navbar-icons">
<? if( $row->status == Items::STATUS_CLOSE ): ?>
		                                    <li><a href="/administrator/items/open/?id=<?php echo $row->id; ?>" class="tip" title="Открыть"><i class="fam-lock-open"></i></a></li>
<? else: ?>
                                            <li><a href="/administrator/items/close/?id=<?php echo $row->id; ?>" class="tip" title="Закрыть"><i class="fam-lock"></i></a></li>
<? endif; ?>
                                            <li><a href="/administrator/items/edit/?id=<?php echo $row->id; ?>" class="tip" title="Редактировать"><i class="fam-pencil"></i></a></li>
		                                    <li><a href="/administrator/items/delete/?id=<?php echo $row->id; ?>" class="tip" title="Удалить"><i class="fam-cross"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
<? endforeach; ?>
                            </tbody>
                        </table>

<br />
<br />
                        <div class="pagination">
                            <ul>
<?php
$this->widget('CLinkPager', array(
'pages' => $pagination, 
'firstPageLabel'=>'&larr;',
'prevPageLabel'=>'Предыдущая',
'nextPageLabel'=>'Следующая',
'lastPageLabel'=>'&rarr;',
'header'=>'', 
'cssFile'=>false
))
?>

                    </div>
                </div>
                <!-- /media datatable -->