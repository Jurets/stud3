<?php
class BackController extends CController
{
	public $layout = 'webroot.themes.backend_new.views.layouts.main';

    public function filters()
    {
        return array(
            array( 'application.modules.administrator.filters.AccessControl' )
        );
    }

    public function init()
    {	
		Yii::app()->theme = 'backend_new';

		Yii::app()->getClientScript()->registerCoreScript('jquery');
	}
}