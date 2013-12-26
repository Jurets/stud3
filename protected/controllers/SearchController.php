<?php
class SearchController extends Controller
{
    public function actionIndex($type = '')
    {
		if( $type == 'users' )
		{
			$this->actionUsers();
		}
		elseif( $type == 'items' )
		{
			$this->actionItems();
		}
		else
		{
			$this->actionProjects();
		}
	}

    public function actionProjects()
    {
		Yii::app()->getModule('tenders');

		$model = Tenders::model()->opened();

		$keywords = CHtml::encode(Yii::app()->request->getParam('keywords'));

		$criteria = new CDbCriteria;

		if( $keywords )
		{
			if( strlen($keywords) < 2 )
			{
				$keywords = "";

				unset($_GET['keywords']);
			}
			else
			{
				$criteria->addSearchCondition('title', $keywords, true);
		
				$criteria->addSearchCondition('text', $keywords, true, 'OR');
			}
		}

		$dataProvider = new CActiveDataProvider($model, array(
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'budget'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 10,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'keywords' => $keywords
		);

		$this->pageTitle = 'Фриланс биржа. Удаленная работа.';

		$this->render('projects', $renderdata);
	}

    public function actionItems()
    {
		Yii::app()->getModule('items');

		$model = Items::model()->opened();

		$keywords = CHtml::encode(Yii::app()->request->getParam('keywords'));

		$criteria = new CDbCriteria;

		if( $keywords )
		{
			if( strlen($keywords) < 2 )
			{
				$keywords = "";

				unset($_GET['keywords']);
			}
			else
			{
				$criteria->addSearchCondition('title', $keywords, true);
		
				$criteria->addSearchCondition('text', $keywords, true, 'OR');
			}
		}

		$dataProvider = new CActiveDataProvider($model, array(   
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'date' => true
				),
				'attributes' => array(
					'date',
					'title',
					'cost'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 10,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'keywords' => $keywords
		);

		$this->pageTitle = 'Фриланс биржа. Удаленная работа.';

		$this->render('items', $renderdata);
	}

    public function actionUsers()
    {	
		Yii::app()->getModule('portfolio');

		$model = User::model()->active()->with('static');

		$keywords = CHtml::encode(Yii::app()->request->getParam('keywords'));

		$criteria = new CDbCriteria;

		if( $keywords )
		{
			if( strlen($keywords) < 2 )
			{
				$keywords = "";

				unset($_GET['keywords']);
			}
			else
			{
				$criteria->addSearchCondition('username', $keywords, true);
		
				$criteria->addSearchCondition('name', $keywords, true, 'OR');
			}
		}

		$dataProvider = new CActiveDataProvider($model, array( 
			'criteria' => $criteria,
			'sort' => array(
				'sortVar' => 's',
				'defaultOrder' => array(
					'rating' => true
				),
				'attributes' => array(
					'rating',
					'static.reviews_positive'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'keywords' => $keywords
		);

		$this->pageTitle = 'Фриланс биржа. Удаленная работа.';

		$this->render('users', $renderdata);
	}
}