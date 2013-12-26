
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?=CHtml::encode($this->pageTitle)?></title>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&amp;sensor=false"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/prettify.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.elfinder.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.listbox.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.validation.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.form.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/tables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/files/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/files/functions.js"></script>




</head>

<body>

	<!-- Fixed top -->
	<div id="top">
		<div class="fixed">
			<a href="/administrator" title="" class="logo">Система управления</a>
			<ul class="top-menu">
				<li><a class="fullview"></a></li>
				<li><a class="showmenu"></a></li>
				<li class="dropdown">
					<a class="user-menu" data-toggle="dropdown"><img src="<?php echo Yii::app()->getModule('user')->userpicsDir.$this->user->userpic; ?>" alt="" width="24" /><span>Добро пожаловать, <?php echo $this->user->username; ?>! <b class="caret"></b></span></a>
					<ul class="dropdown-menu">
						<li><a href="#" title=""><i class="icon-user"></i>Профиль</a></li>
						<li><a href="#" title=""><i class="icon-remove"></i>Выход</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /fixed top -->


	<!-- Content container -->
	<div id="container">

		<!-- Sidebar -->
		<div id="sidebar">

			<div class="sidebar-tabs">
		        <ul class="tabs-nav two-items" style="display:none">
		            <li><a href="#general" title=""><i class="icon-reorder"></i></a></li>
		        </ul>

		        <div id="general">

				    <!-- Main navigation -->
			        <ul class="navigation widget">
			            <li<? if( Yii::app()->controller->getAction()->getId() == 'index' ): ?> class="active"<? endif; ?>><a href="/administrator" title=""><i class="icon-home"></i>Главная</a></li>
			            <li<? if( $this->action == 'pages' ): ?> class="active"<? endif; ?>><a href="#" title="" class="expand"><i class="icon-reorder"></i>Страницы</a>
			                <ul>
			                    <li><a href="/administrator/pages" title="">Список страниц</a></li>
			                    <li><a href="/administrator/pages/add" title="">Добавить страницу</a></li>
			                </ul>
			            </li>
			            <li<? if( $this->action == 'news' ): ?> class="active"<? endif; ?>><a href="#" title="" class="expand"><i class="icon-reorder"></i>Новости</a>
			                <ul>
			                    <li><a href="/administrator/news" title="">Список новостей</a></li>
			                    <li><a href="/administrator/news/add" title="">Добавить новость</a></li>
			                </ul>
			            </li>
			            <li<? if( $this->action == 'users' ): ?> class="active"<? endif; ?>><a href="#" title="" class="expand"><i class="icon-user"></i>Пользователи</a>
			                <ul>
			                    <li><a href="/administrator/users" title="">Список пользователей</a></li>
			                </ul>
			            </li>
			            <li<? if( $this->action == 'items' ): ?> class="active"<? endif; ?>><a href="#" title="" class="expand"><i class="icon-picture"></i>Товары</a>
			                <ul>
			                    <li><a href="/administrator/items" title="">Список товаров</a></li>
			                </ul>
			            </li>
			            <li<? if( $this->action == 'tenders' ): ?> class="active"<? endif; ?>><a href="#" title="" class="expand"><i class="icon-picture"></i>Проекты</a>
			                <ul>
			                    <li><a href="/administrator/tenders" title="">Список проектов</a></li>
			                </ul>
			            </li> 
			        </ul>

			        <ul class="navigation widget">
			            <li<? if( $this->action == 'messages' ): ?> class="active"<? endif; ?>><a href="/administrator/messages" title=""><i class="fam-email"></i>Последние диалоги</a></li>
			            <li<? if( $this->action == 'withdraw' ): ?> class="active"<? endif; ?>><a href="/administrator/withdraw" title=""><i class="fam-money-add"></i>Заявки на вывод</a></li>
			            <li<? if( $this->action == 'sbs' ): ?> class="active"<? endif; ?>><a href="/administrator/sbs" title=""><i class="fam-money"></i>Безопасная сделка</a></li>
			        </ul>
                    
			        <!-- /main navigation -->

		        </div>

		    </div>
		</div>
		<!-- /sidebar -->



		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">


			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a href="/administrator">Панель управления</a></li>
		                <li class="active"><a href="#" title=""><?=CHtml::encode($this->pageTitle)?></a></li>
		            </ul>
			        
		            <ul class="alt-buttons">
		                <li><a href="/administrator/messages" title=""><i class="icon-comments"></i><span>Последние диалоги</span></a></li>
		                <li><a href="/administrator/withdraw" title="" ><i class="icon-tasks"></i><span>Заявки на вывод</span></a>
		            </ul>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Панель управления</h5>
				    	<span>Добро пожаловать, <?php echo $this->user->username; ?>!</span>
			    	</div>

			    	<ul class="page-stats">
			    		<li>
			    			<div class="showcase">
			    				<span>Переходов</span>
			    				<h2>0</h2>
			    			</div>
			    		</li>
			    		<li>
			    			<div class="showcase">
			    				<span>Мой баланс</span>
			    				<h2><?php echo $this->user->balance; ?> руб.</h2>
			    			</div>
			    		</li>
			    	</ul>
			    </div>
			    <!-- /page header -->
                
                
                
<?php echo $content; ?>
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->

	</div>
	<!-- /content container -->


	<!-- Footer -->
	<div id="footer">

	</div>
	<!-- /footer -->

</body>
</html>