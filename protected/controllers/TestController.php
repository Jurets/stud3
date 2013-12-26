<?php
class TestController extends Controller
{
	public $layout = false;

    public function actionIndex()
    {
		Yii::app()->getModule('portfolio');

		$model = Portfolio::model()->user(71)->findAll();

		$renderdata = array(
			'model' => $model
		);

		$this->renderPartial('projects', $renderdata);
	}

    public function actionSite()
    {
		Yii::app()->getModule('portfolio');

		$model = Portfolio::model()->user(71)->findAll();

		$renderdata = array(
			'model' => $model
		);

		$this->renderPartial('site', $renderdata);
	}

    public function actionPortfolio()
    {
		Yii::app()->getModule('portfolio');

		$model = Portfolio::model()->user(71)->findAll();

		$renderdata = array(
			'model' => $model
		);

		$this->renderPartial('portfolio', $renderdata);
	}
}