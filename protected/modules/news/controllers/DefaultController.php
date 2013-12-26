<?php
class DefaultController extends Controller
{
    /**
     * Список
     */
	public function actionIndex()
	{
		$model = News::model();

		$dataProvider = new CActiveDataProvider($model, array(   
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'title',
					'like',
					'comments'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider
		);

		$this->pageTitle = 'Новости';

		$this->render('index', $renderdata);
	}

    /**
     * Просмотр
     */
	public function actionShow($id = '')
	{
    	$model = News::model()->findByPk($id);

    	if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$this->pageTitle = $model->title;

    	$this->render('show', array('model' => $model));
	}	
}