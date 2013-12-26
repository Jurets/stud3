<?php
class RssController extends Controller
{
	public $layout = 'rss';

	public $title = 'Rss Лента';

	public $description = '';

    public function actionProjects($category = '')
    {
		Yii::app()->getModule('tenders');

		$this->title = 'Проекты на Wkbox.ru';

		$this->description = 'Проекты на Wkbox.ru';

		$renderdata = array(
			'projects' => Tenders::model()->opened()->findAll(),
		);

		header("Content-Type: application/rss+xml");

		$this->renderPartial('projects', $renderdata); 
	}
}