		    	<h5 class="widget-name"><i class="icon-th"></i>Заявки на вывод</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Заявки на вывод</h6>
                        </div>
                    </div>
                    <div class="table-overflow">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Сумма</th>
                                    <th>Пользователь</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<? foreach($list as $row): ?>
                                <tr>
			                        <td><a href="#" title=""><?php echo $row->date(); ?></a></td>
			                        <td><?php echo $row->amount; ?> рублей</td>    
			                        <td><a href="#" title=""><?php echo $row->userdata->username; ?></a></td>
			                        <td><?php echo $row->getStatus(); ?></td>
			                        <td>

                                    </td>
                                </tr>
<? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->