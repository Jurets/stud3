<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=CHtml::encode($this->pageTitle)?></title>
<?
/*
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset-fonts-grids.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/base-min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/globe.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/market.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/contractors.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/users.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/account.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugins.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/pages.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/new.css" />
*/
?>
</head>
<body>
<div class="body">

<div id="ajax-loader"><img src="/images/ajax-loader.gif" /></div>

<div id="custom-doc" class="yui-t5">

<div id="top" class="yui-gd">

<div class="yui-u first logo">
<a href="<?=Yii::app()->params['site']?>"><span></span></a>
</div>

<div style="margin-top:30px; margin-right:10px; float:right;"><a href="/tenders"><img src="/images/wk.png"></a></div>

</div>

<div id="pathway"><a href="<?=Yii::app()->params['site']?>"><?=Yii::app()->name?></a> &raquo; Сеть удаленных специалистов. Поиск удаленной работы.</div>
<div id="topnav">
	<div>
		<div>
			<div style="position:relative;">
            <ul class="ltop">

<li class="first"><i class="icon-home icon-white"></i> <a href="<?=Yii::app()->params['site']?>">Главная</a></li>

</ul>

<ul>
<li class="first"><a href="/news">Новости сервиса</a></li>
<li><a href="/tenders">Удаленная работа</a></li>
<li><a href="/items">Каталог работ</a></li>
<li><a href="/users">Все пользователи</a></li>
<li><a href="/blogs">Блоги</a></li>
<li><a href="/articles">Статьи</a></li>
<li><a href="/help">Помощь</a></li>
</ul>
			</div>
		</div>
	</div>
</div>


<? $this->widget('UserLoginWidget') ?>

<div id="bd">

<?=$content?>

<br clear="all" />

</div>


<div id="ft">
	<div id="ft-inner" class="yui-gf">


	<div class="footer">
		<div class="center">
			<p class="copy"><strong>2012 &copy; Wkbox.ru</strong></p>

			<div class="service">
				<strong>Сервисы</strong>
				<ul>
					<li><a href="/items" title="Товары">Товары</a></li>
					<li><a href="/blogs" title="Блоги">Блоги</a></li>
				</ul>
			</div>

			<div class="about" style="width:200px;">
				<strong>О проекте</strong>
				<ul>
					<li><a href="/pages/contact.html" title="Контакты">Контакты</a></li>
					<li><a href="/pages/about.html" title="О проекте">О проекте</a></li> 
					<li><a href="/pages/agreement.html" title="Пользовательское соглашение">Пользовательское соглашение</a></li> 
				</ul>
			</div><!-- end_about -->

			<div class="about" style="width:200px;">
				<strong>Помощь</strong>
				<ul>
					<li><a href="/help">Разделы</a></li>
					<li><a href="/support">Служба поддержки</a></li>
				</ul>
			</div>

					</div><!-- end_center -->
	</div><!-- end_footer -->

<div id="bottomnav" class="yui-u">
<ul>
<li>
<?php
	//$dbStats = Yii::app()->db->getStats();
	//echo 'Выполнено запросов: '.$dbStats[0].' (за '.round($dbStats[1], 5).' сек)';
?>
</li>
</ul>
</div>

	</div>
</div>



</div>





</div>
<div id="fog"></div>
<div class="fog"></div>
<!-- Yandex.Metrika counter 
<script type="text/javascript">
(function (d, w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter17590303 = new Ya.Metrika({id:17590303, enableAll: true, webvisor:true});
} catch(e) { }
});

var n = d.getElementsByTagName("script")[0],
s = d.createElement("script"),
f = function () { n.parentNode.insertBefore(s, n); };
s.type = "text/javascript";
s.async = true;
s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

if (w.opera == "[object Opera]") {
d.addEventListener("DOMContentLoaded", f);
} else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/17590303" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>