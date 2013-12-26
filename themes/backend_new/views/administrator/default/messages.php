		    	<h5 class="widget-name"><i class="icon-th"></i>Сообщения</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Последние сообщения</h6>
                        </div>
                    </div>
                    <div class="table-overflow">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Текст</th>
                                    <th>Дата отправления</th>
                                    <th>Отправитель</th>
                                    <th>Получатель</th>
                                    <th class="actions-column">Управление</th>
                                </tr>
                            </thead>
                            <tbody>
<? foreach($list as $row): ?>
                                <tr>
			                        <td><?php echo $row->text; ?></td>
			                        <td><?php echo $row->date(); ?></td>
			                        <td><?php echo $row->userdata->username; ?></td>
			                        <td><?php echo $row->recipientdata->username; ?></td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="/administrator/messages/delete/?id=<?php echo $row->id; ?>" class="tip" title="Удалить"><i class="fam-cross"></i></a></li>
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