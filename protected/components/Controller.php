<?php
class Controller extends CController
{
    public $menu = array();

    public $breadcrumbs = array();

    public $description;

    public $keywords;

    public function setpageTitle($title)
    {
        $this->pageTitle = $title;
    }

    public function init()
    {	
		$technicalwork = false;

		if( $technicalwork == true && !Yii::app()->user->isSuperUser() )
		{
			$this->layout = false;

			$this->pageTitle = 'Сеть удаленных специалистов. Поиск удаленной работы.';

			$this->renderPartial('//pages/technicalwork');

			Yii::app()->end();
		}


        if( !Yii::app()->request->isAjaxRequest )
		{
			if( isset($_SERVER['HTTP_REFERER']) )
			{
				$_lo = strpos($_SERVER['HTTP_REFERER'],"http://fnetwork.ru");
	
				if( $_lo === false )
				{
					//если реферал внешний
					$ref = $_SERVER['HTTP_REFERER'];
					$page = $_SERVER['PHP_SELF'];
	
					Yii::app()->db->createCommand()
						->insert('{{transitions}}', array('ip' => Yii::app()->request->userHostAddress, 'date' => time(), 'ref' => $ref, 'page' => $page));
				}
			}
		}

		if( Yii::app()->request->isAjaxRequest )
		{
			$this->layout = false;
		}

        if( !Yii::app()->user->isGuest )
		{
			if( !Yii::app()->request->isAjaxRequest )
			{
				//$user = User::model()->findByPk(Yii::app()->user->id);
	
				//$user->setLastActivity();
	
				//$user->update(array('last_activity', 'online'));
			}
		}

        $baseUrl = Yii::app()->baseUrl;

        $assetUrl = Yii::app()->baseUrl;


		Yii::app()->getClientScript()->registerCoreScript('jquery');

		Yii::app()->clientScript->registerMetaTag(Yii::app()->getRequest()->getCsrfToken(), Yii::app()->getRequest()->csrfTokenName);






		// Jcrop
		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/jcrop/js/jquery.Jcrop.min.js' );

		Yii::app()->getClientScript()->registerCssFile( $assetUrl.'/files/jcrop/css/jquery.Jcrop.min.css' );


		// sticky
		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/sticky/sticky.full.js' );

		Yii::app()->getClientScript()->registerCssFile( $assetUrl.'/files/sticky/sticky.full.css' );


		// bootstrap
		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/bootstrap/js/bootstrap.js' );

		Yii::app()->getClientScript()->registerCssFile( $assetUrl.'/files/bootstrap/css/bootstrap.min.css' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/common.js' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/crop.js' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/blog.js' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/commune.js' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/favorites.js' );

		Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/portfolio.js' );

		if( Yii::app()->user->isAuthenticated() )
		{
			Yii::app()->getClientScript()->registerScriptFile( $assetUrl.'/files/js/auth.js' );
		}

	}
}