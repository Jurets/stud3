<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    '/commune/<id:\d+>' => 'commune/default/show',
    '/commune/blog/<id:\d+>' => 'commune/blog/',
    '/commune/create' => 'commune/default/create',
    '/commune/blog/publication/<id:\d+>' => '/commune/blog/publication',
    '/commune/blog/delete/<id:\d+>' => '/commune/blog/delete',

    '/sbs/<id:\d+>' => 'sbs/default/show/',
    '/sbs/publication/<id:\d+>' => 'sbs/default/publication/',
    '/sbs/reserve/<id:\d+>' => 'sbs/default/reserve/',
    '/sbs/done/<id:\d+>' => 'sbs/default/done/',
    '/sbs/sendwork/<id:\d+>' => 'sbs/default/sendwork/',
    '/sbs/arbitration/<id:\d+>' => 'sbs/default/arbitration',
    '/sbs/complete/<id:\d+>' => 'sbs/default/complete',
    '/sbs/prolongation/<id:\d+>' => 'sbs/default/prolongation',
    '/sbs/close/<id:\d+>' => 'sbs/default/close',

    '/articles/<id:\d+>.html' => 'articles/default/show/',
    '/articles/publication' => 'articles/default/publication',
    '/articles/publication/<id:\d+>' => 'articles/default/publication',
    '/articles/delete/<id:\d+>' => 'articles/default/delete',

	'/search' => 'search/index',
    '/help/<id:\d+>.html' => 'help/default/index/',

    '/tenders/bidmanagement' => 'tenders/default/bidmanagement',
    '/tenders/management' => 'tenders/default/management',
    '/tenders/publication' => 'tenders/default/publication',
    '/tenders/<id:\d+>.html' => 'tenders/default/show/',
    '/news/<id:\d+>.html' => 'news/default/show/',

    '/items/bugtracker/<id:\d+>' => 'items/bugtracker/index/',
    '/items/bugtracker/add/<id:\d+>' => 'items/bugtracker/add/',

    '/blogs/publication' => 'blogs/default/publication',
    '/blogs/publication/<id:\d+>' => 'blogs/default/publication',
    '/blogs/delete/<id:\d+>' => 'blogs/default/delete',
    '/blogs/<id:\d+>.html' => 'blogs/default/show/',

    '/blogs/<_a:(my|new|favorites)>' => 'blogs/default/index/section/<_a>',

    '/items/delete' => 'items/default/delete',
    '/items/management' => 'items/default/management',
    '/items/publication' => 'items/default/publication',
    '/items/script' => 'items/default/script',
    '/items/<id:\d+>.html' => 'items/default/show/',
    '/items/demo/<id:\d+>' => 'items/default/demo/',
    '/pages/<name:>.html' => 'pages/default/show/',

    '/contacts/add' => 'contacts/default/add',
    '/contacts/AddGroup' => 'contacts/default/AddGroup',
    '/contacts/send/<username:>' => 'contacts/default/send/<_a>',

    '/portfolio/delete' => 'portfolio/default/delete',
    '/portfolio/publication' => 'portfolio/default/publication',

    '/user/recoveryPassword' => 'user/default/recoveryPassword',

    '/account' => 'user/account',
    '/account/<_a:(purchased|favorites|skills|resume|notify|guests|items|myinvitations|invitations|contacts|notice|logo|tenders|bids|payments|portfolio|tariff|services|balance|withdraw|addwithdraw|history|purses|addpurse|deletepurse|events|event|rating|index|userpic|profile|contact|changepassword|blogs)>' => 'user/account/<_a>',
    '/account/payments/<id:\d+>.html' => 'user/account/viewpayment',
    '/account/tenders/<status>' => 'user/account/tenders',

    '/users' => 'user/default',
    '/users/<username:>' => 'user/profile/index/<_a>',
    '/users/<_a:(favorites|contacts|index|invite|items|blog|portfolio|reviews|addreview)>/<username:>' => 'user/profile/<_a>',

    '/registration/invite' => 'user/default/registrationinvite',

    '/login' => 'user/default/login',
    '/logout' => 'user/default/logout',
    '/registration' => 'user/default/registration',
    '/registration2' => 'user/default/registration2',
    '/recovery' => 'user/default/recovery',
    '/support' => 'user/default/support',
    '/activation' => 'user/default/activation',
    '/confirmation' => 'user/default/confirmation',
	'/activated/id/<user_id:\d+>' => 'user/default/activated',
	
    '/administrator/<module:(pages|sbs|users|tenders|sbs|items|messages|withdraw|news)>/<action:>' => 'administrator/default/list/',
    '/administrator/<module:(pages|sbs|users|tenders|sbs|items|messages|withdraw|news)>' => 'administrator/default/list/',

);