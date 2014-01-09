<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="ru-RU"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="ru-RU"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="ru-RU"> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9" lang="ru-RU"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="ru-RU"> <!--<![endif]-->
<head>
    <title><?php echo $this->pageTitle; ?></title>
    <meta name="description" content="<?php echo $this->pageTitle; ?>"/>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/favicon.ico"
          type="image/x-icon"/>
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img
            src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt=""/></a>
    </div>
    <![endif]-->
    <link rel="stylesheet" type="text/css" media="all"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" media="all"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/bootstrap/css/responsive.css"/>
    <link rel="stylesheet" type="text/css" media="all"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/css/prettyPhoto.css"/>
    <link rel="stylesheet" type="text/css" media="all"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/css/camera.css"/>
    <link rel="stylesheet" type="text/css" media="all"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/style.css"/>


    <link rel='stylesheet' id='contact-form-7-css'
          href='<?php echo Yii::app()->theme->baseUrl; ?>/imports/plugins/contact-form-7/includes/css/styles.css?ver=3.5.2'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='font-awesome-css'
          href='http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css?ver=3.2.1' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='magnific-popup-css'
          href='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/css/magnific-popup.css?ver=0.9.3'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='options_typography_Open+Sans-css'
          href='http://fonts.googleapis.com/css?family=Open+Sans&#038;subset=latin' type='text/css' media='all'/>
    <link rel='stylesheet' id='options_typography_Damion-css'
          href='http://fonts.googleapis.com/css?family=Damion&#038;subset=latin' type='text/css' media='all'/>
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/js/comment-reply.min.js?ver=3.7.1'></script>
<!--    <script type='text/javascript'-->
<!--            src='--><?php //echo Yii::app()->theme->baseUrl; ?><!--/imports/themes/CherryFramework/js/jquery-1.7.2.min.js?ver=1.7.2'></script>-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<!--    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script>
        $(function() {
            $( ".datepicker" ).datepicker({
                'dateFormat' : 'dd.mm.yy'
            });
        });
    </script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/js/swfobject.js?ver=2.2-20120417'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/modernizr.js?ver=2.0.6'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.elastislide.js?ver=1.0'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jflickrfeed.js?ver=1.0'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/custom.js?ver=1.0'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/bootstrap/js/bootstrap.min.js?ver=2.3.0'></script>

    <style type='text/css'>
        h1 {
            font: normal 30px/36px Open Sans;
            color: #bdb23a;
        }

        h2 {
            font: normal 24px/29px Open Sans;
            color: #bdb23a;
        }

        h3 {
            font: normal 20px/24px Open Sans;
            color: #bdb23a;
        }

        h4 {
            font: normal 18px/22px Open Sans;
            color: #bdb23a;
        }

        h5 {
            font: normal 16px/19px Open Sans;
            color: #bdb23a;
        }

        h6 {
            font: normal 14px/17px Open Sans;
            color: #bdb23a;
        }

        .main-holder {
            font: normal 13px/18px "Trebuchet MS", Arial, Helvetica, sans-serif;
            color: #000000;
        }

        .logo_h__txt, .logo_link {
            font: normal 45px/50px Damion;
            color: #ffffff;
        }

        .sf-menu > li > a {
            font: normal 12px/18px Open Sans;
            color: #ffffff;
        }

        .nav.footer-nav a {
            font: normal 13px/18px "Trebuchet MS", Arial, Helvetica, sans-serif;
            color: #0a7f5f;
        }
    </style>

    <!--[if (gt IE 9)|!(IE)]><!-->
    <script
        src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.mobile.customized.min.js"
        type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(function () {
            jQuery('.sf-menu').mobileMenu({defaultText: "Перейти в..."});
        });
    </script>
    <!--<![endif]-->

    <script type="text/javascript">
        // Init navigation menu
        jQuery(function () {
            // main navigation init
            jQuery('ul.sf-menu').superfish({
                delay: 1000, 		// the delay in milliseconds that the mouse can remain outside a sub-menu without it closing
                animation: {opacity: 'show', height: 'show'}, // used to animate the sub-menu open
                speed: 'normal',  // animation speed 
                autoArrows: false,   // generation of arrow mark-up (for submenu)
                disableHI: true // to disable hoverIntent detection
            });

            //Zoom fix
            //IPad/IPhone
            var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
                ua = navigator.userAgent,
                gestureStart = function () {
                    viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
                },
                scaleFix = function () {
                    if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                        viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                        document.addEventListener("gesturestart", gestureStart, false);
                    }
                };

            scaleFix();
        })
    </script>

    <style type="text/css">

        body {
            background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/images/bg.jpg);
            background-repeat: repeat;
            background-position: top center;
            background-attachment: scroll;
        }
    </style>
</head>


<body class="home page page-id-203 page-template page-template-page-home-php">
<div id="motopress-main" class="main-holder">
<!--Begin #motopress-main-->
<header class="motopress-wrapper header">
    <div class="light-header"></div>
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="wrapper/wrapper-header.php"
                 data-motopress-wrapper-type="header" data-motopress-id="52a6073155041">
                <div class="row">
                    <div class="logo-wrap" data-motopress-type="static"
                         data-motopress-static-file="static/static-logo.php">
                        <!-- BEGIN LOGO -->
                        <div class="logo pull-left img-logo">
                            <a href="<?php echo Yii::app()->baseUrl; ?>" class="logo_h logo_h__img"><img
                                    src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/images/logo.png"
                                    alt="Tutoring" title="Private teachers"></a>

                            <p class="logo_tagline">Private teachers</p><!-- Site Tagline -->
                        </div>
                        <!-- END LOGO -->    </div>
                    <div class="span12 " data-motopress-type="static"
                         data-motopress-static-file="static/static-nav.php">
                        <!-- BEGIN MAIN NAVIGATION -->
                        <div class="nav-wrap">
                            <nav class="nav nav__primary clearfix">
                                <ul id="topnav" class="sf-menu">
                                    <li id="menu-item-1807"
                                        class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-203 current_page_item">
                                        <a href="<?php echo Yii::app()->theme->baseUrl; ?>/">Home</a></li>
                                    <li id="menu-item-1810"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                                        <a href="<?php echo Yii::app()->theme->baseUrl; ?>/about-us/">About Us</a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-1811"
                                                class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/about-us/testi/">Testimonials</a>
                                            </li>
                                            <li id="menu-item-1812"
                                                class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/about-us/archives/">Archives</a>
                                            </li>
                                            <li id="menu-item-1805"
                                                class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/about-us/faqs/">FAQs</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-1808"
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                                        <a href="<?php echo Yii::app()->theme->baseUrl; ?>/portfolio/">For Students</a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-1815"
                                                class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/portfolio/portfolio-2/">For
                                                    Students 2</a></li>
                                            <li id="menu-item-1814"
                                                class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/portfolio/portfolio-3/">For
                                                    Students 3</a></li>
                                            <li id="menu-item-1813"
                                                class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                                    href="<?php echo Yii::app()->theme->baseUrl; ?>/portfolio/portfolio-4/">For
                                                    Students 4</a></li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-1809"
                                        class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                            href="<?php echo Yii::app()->theme->baseUrl; ?>/for-tutors/">For Tutors</a>
                                    </li>
                                    <li id="menu-item-1806"
                                        class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                            href="<?php echo Yii::app()->theme->baseUrl; ?>/blog/">Blog</a></li>
                                    <li id="menu-item-1804"
                                        class="menu-item menu-item-type-post_type menu-item-object-page"><a
                                            href="<?php echo Yii::app()->theme->baseUrl; ?>/contacts/">Contacts</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- END MAIN NAVIGATION -->    </div>
                </div>
            </div>
        </div>
    </div>
    
</header>

<div class="motopress-wrapper content-holder clearfix">
    <div class="container">
    
        <!--<div id="auth" style="width: auto; height: auto; float: left; position: absolute; z-index: 999; margin-left: 600px;">-->
        <!--<div id="auth" style="width: auto; height: auto; position: absolute; z-index: 999; margin-left: 600px;">
            <?php 
            if (!Yii::app()->user->isGuest)  {
                $user = User::model()->findByPk(Yii::app()->user->id);
            ?>
                <p>Пользователь: <?= $user->username?></p>
                <a class="green-submit" href="<?= Yii::app()->createAbsoluteUrl('logout') ?>">Выход</a>
            <? } else { ?>
                <a class="green-submit" href="<?= Yii::app()->createAbsoluteUrl('login') ?>">Вход</a>
            <?php } ?>
        </div>-->        
    
        <?php echo $content; ?>
    </div>
</div>

<footer class="motopress-wrapper footer">
    <div class="container">
        <div class="row">
            <div class="span12" data-motopress-wrapper-file="wrapper/wrapper-footer.php"
                 data-motopress-wrapper-type="footer" data-motopress-id="52a607317f020">
                <div class="row copyright footer-widgets">
                    <div class="span2 copyright-wrap" data-motopress-type="static"
                         data-motopress-static-file="static/static-footer-text.php">
                        <div id="footer-text" class="footer-text">

                            <a href="<?php echo Yii::app()->theme->baseUrl; ?>/" title="Private teachers"
                               class="site-name"><img
                                    src="<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/theme45716/images/logo-footer.png"></a>
                            <span>&copy; 2013 <a href="<?php echo Yii::app()->theme->baseUrl; ?>/privacy-policy/"
                                                 title="Политика конфиденциальности">Политика
                                    конфиденциальности</a></span>
                            <!-- {%FOOTER_LINK} -->
                        </div>
                    </div>
                    <div class="span1"></div>
                    <div class="span2" data-motopress-type="dynamic-sidebar"
                         data-motopress-sidebar-id="footer-sidebar-1">
                        <div id="nav_menu-2"><h4>subjects:</h4>

                            <div class="menu-footer-widget-menu-1-container">
                                <ul id="menu-footer-widget-menu-1" class="menu">
                                    <li id="menu-item-1878"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1878">
                                        <a href="#">Maths Tutors</a></li>
                                    <li id="menu-item-1879"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1879">
                                        <a href="#">English Tutors</a></li>
                                    <li id="menu-item-1880"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1880">
                                        <a href="#">Physics Tutors</a></li>
                                    <li id="menu-item-1881"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1881">
                                        <a href="#">Chemistry Tutors</a></li>
                                    <li id="menu-item-1882"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1882">
                                        <a href="#">Biology Tutors</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="span2" data-motopress-type="dynamic-sidebar"
                         data-motopress-sidebar-id="footer-sidebar-2">
                        <div id="nav_menu-5">
                            <div class="menu-footer-widget-menu-2-container">
                                <ul id="menu-footer-widget-menu-2" class="menu">
                                    <li id="menu-item-1883"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1883">
                                        <a href="#">Law Tutors</a></li>
                                    <li id="menu-item-1884"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1884">
                                        <a href="#">History Tutors</a></li>
                                    <li id="menu-item-1885"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1885">
                                        <a href="#">View all subjects</a></li>
                                    <li id="menu-item-1886"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1886">
                                        <a href="#">Piano Lessons</a></li>
                                    <li id="menu-item-1887"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1887">
                                        <a href="#">Singing Lessons</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="span2" data-motopress-type="dynamic-sidebar"
                         data-motopress-sidebar-id="footer-sidebar-3">
                        <div id="nav_menu-4"><h4>locations:</h4>

                            <div class="menu-footer-widget-menu-3-container">
                                <ul id="menu-footer-widget-menu-3" class="menu">
                                    <li id="menu-item-1888"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1888">
                                        <a href="#">London Tutors</a></li>
                                    <li id="menu-item-1889"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1889">
                                        <a href="#">All London Areas</a></li>
                                    <li id="menu-item-1890"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1890">
                                        <a href="#">All London Areas</a></li>
                                    <li id="menu-item-1891"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1891">
                                        <a href="#">Leicester Tutors</a></li>
                                    <li id="menu-item-1892"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1892">
                                        <a href="#">All UK Areas</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="span2" data-motopress-type="dynamic-sidebar"
                         data-motopress-sidebar-id="footer-sidebar-4">
                        <div id="nav_menu-3"><h4>classes:</h4>

                            <div class="menu-footer-widget-menu-4-container">
                                <ul id="menu-footer-widget-menu-4" class="menu">
                                    <li id="menu-item-1893"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1893">
                                        <a href="#">London Lessons</a></li>
                                    <li id="menu-item-1894"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1894">
                                        <a href="#">English Lessons</a></li>
                                    <li id="menu-item-1895"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1895">
                                        <a href="#">French Lessons</a></li>
                                    <li id="menu-item-1896"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1896">
                                        <a href="#">German Lessons</a></li>
                                    <li id="menu-item-1897"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1897">
                                        <a href="#">All UK Counties</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12" data-motopress-type="static"
                         data-motopress-static-file="static/static-footer-nav.php">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End #motopress-main-->
</div>
<div id="back-top-wrapper" class="visible-desktop">
    <p id="back-top">
        <a href="#top"><span></span></a>
    </p>
</div>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.40.0-2013.08.13'></script>
<script type='text/javascript'>
    /* <![CDATA[ */
    var _wpcf7 = <?php echo CJSON::encode((object)array('sending' => 'Загружаю...', 'loaderUrl' => Yii::app()->theme->baseUrl .'/imports/plugins/contact-form-7/images/ajax-loader.gif'))?>;
    /* ]]> */

</script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/plugins/contact-form-7/includes/js/scripts.js?ver=3.5.2'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/superfish.js?ver=1.5.3'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.mobilemenu.js?ver=1.0'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.easing.1.3.js?ver=1.3'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.magnific-popup.min.js?ver=0.9.3'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.flexslider.js?ver=2.1'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jplayer.playlist.min.js?ver=2.3.0'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/jquery.jplayer.min.js?ver=2.4.0'></script>
<script type='text/javascript'
        src='<?php echo Yii::app()->theme->baseUrl; ?>/imports/themes/CherryFramework/js/camera.min.js?ver=1.3.4'></script>

</body>
</html>