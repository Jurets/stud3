		    	<h5 class="widget-name"><i class="icon-th"></i>Сделки</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Список сделок</h6>
                        </div>
                    </div>
                    <div class="table-overflow">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Проект</th>
                                    <th>Сумма</th>
                                    <th>Заказчик</th>
                                    <th>Исполнитель</th>
                                    <th>Дата добавления</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<? foreach($list as $row): ?>
                                <tr>
			                        <td><a href="#" title=""><?php echo $row->project->title; ?></a></td>
			                        <td><?php echo $row->amount; ?> рублей</td>    
			                        <td><a href="#" title=""><?php echo $row->customer->username; ?></a></td>
			                        <td><a href="#" title=""><?php echo $row->performer->username; ?></a></td>
			                        <td><?php echo $row->date(); ?></td>
			                        <td>
<? if( $row->arbitration ): ?>
<a href="/administrator/default/arbitration/?id=<?php echo $row->id; ?>" title="">Арбитраж</a>
<? else: ?>
									<?php echo $row->getStatus(); ?>
<? endif; ?>
                                    </td>
			                        <td>
<? if( $row->arbitration ): ?>
<strong><?=$row->arbitration->userdata->username?> подал жалобу в арбитраж</strong>
<br />
<a href="/administrator/default/arbitration/?id=<?php echo $row->id; ?>" title="">Арбитраж</a>
<? endif; ?>
                                    </td>
                                </tr>
<? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->