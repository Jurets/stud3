		    	<h5 class="widget-name"><i class="icon-th"></i>Новости</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Список новостей</h6>
                            <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="/administrator/news/add"><i class="icon-plus"></i>Добавить новость</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-overflow">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Заголовок</th>
                                    <th>Дата добавления</th>
                                    <th class="actions-column">Управление</th>
                                </tr>
                            </thead>
                            <tbody>
<? foreach($list as $row): ?>
                                <tr>
			                        <td><a href="#" title=""><?php echo $row->title; ?></a></td>
			                        <td><?php echo $row->date(); ?></td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="/administrator/news/edit/?id=<?php echo $row->id; ?>" class="tip" title="Редактировать"><i class="fam-pencil"></i></a></li>
		                                    <li><a href="/administrator/news/delete/?id=<?php echo $row->id; ?>" class="tip" title="Удалить"><i class="fam-cross"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
<? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->