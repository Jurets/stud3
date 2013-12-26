<?php
class DefaultController extends Controller
{
    /**
     * просмотр
     */
	public function actionShow($name = '')
	{
    	$model = Pages::model()->find('name = :name', array(':name' => $name));

    	if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$this->pageTitle = $model->title;

    	$this->render('show', array('model' => $model));
	}	
}