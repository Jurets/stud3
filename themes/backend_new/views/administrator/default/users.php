		    	<h5 class="widget-name"><i class="icon-th"></i>Пользователи</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Список страниц</h6>
                            <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-overflow">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Заголовок</th>
                                    <th>Название</th>
                                    <th>Дата добавления</th>
                                    <th class="actions-column">Управление</th>
                                </tr>
                            </thead>
                            <tbody>
<? foreach($list as $row): ?>
                                <tr>
			                        <td><a href="#" title=""><?php echo $row->username; ?></a></td>
			                        <td><?php echo $row->name; ?></td>
			                        <td><?php echo Date_helper::date_smart($row->created); ?></td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="/administrator/users/edit/?id=<?php echo $row->id; ?>" class="tip" title="Редактировать"><i class="fam-pencil"></i></a></li>
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