<?php
class DefaultController extends Controller
{
    public function filters()
    {
        return array(
			'ajaxOnly + favorite, like, json',// только ajax запросы
            array('UserFilter + publication, delete'),
			array('UserFilter + show', 'activation' => true),// чтобы запретить комментирование
        );
    }

    /**
     * Список
     */
	public function actionIndex($tag = '')
	{
		$model = Articles::model();

		if( $tag )
		{
			$model = $model->withTags($tag);
		}

		$criteria = new CDbCriteria;

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
					'views',
					'comments'
				)
			),
			'pagination' => array(
				'pageVar' => 'p',
				'pageSize' => 20,
			),
		));

		$renderdata = array(
			'dataProvider' => $dataProvider,
			'section' => $section,
			'tags' => Articles::model()->getAllTagsWithModelsCount(),// все тэги
			'TopUsers' => Articles::getTopUsers(),// популярные блогеры
		);

		$this->pageTitle = 'Статьи';

		$this->render('index', $renderdata);
	}

    /**
     * Просмотр
     */
	public function actionShow($id = '')
	{
		Yii::app()->getClientScript()->registerCssFile( '/files/bootstrap-editable/css/bootstrap-editable.css' );

		Yii::app()->getClientScript()->registerScriptFile( '/files/bootstrap-editable/js/bootstrap-editable.js' );

    	$model = Articles::model()->findByPk($id);

    	if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$model->updateViews();

		$comment = new ArticlesComments;

		$renderdata = array(
			'model' => $model,
			'categories' => $categories,
			'comment' => $comment
		);

		$this->pageTitle = $model->title;

    	$this->render('show', $renderdata);
	}

    /**
     * Удалить
     */
	function actionDelete($id)
	{
		$model = Articles::model()->findByPk($id);
	
		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}
	
		if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)))
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		// удаляем блог
		$model->delete();

		Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Запись успеша удалена');

		$this->redirect('/articles');
	}

    /**
     * Добавить
     */
	public function actionPublication($id = '')
	{
		if( $id )
		{
			$model = Articles::model()->findByPk($id);
		
			if( !$model )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}
	
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)) )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}
		}
		else
		{
			$model = new Articles;
		}

		if( Yii::app()->request->isPostRequest && !empty($_POST['Articles']) )
        {	
			$model->setAttributes($_POST['Articles']);       

			$model->preview = CUploadedFile::getInstance($model, 'preview');

			if( $model->validate() )
            {
				if( $model->preview )
				{
					$sourcePath = pathinfo($model->preview->getName());	
			
					$previewName = md5(time()).'.'.$sourcePath['extension'];

					$model->_preview = $model->preview;

					$model->preview = $previewName;
				}
				else
				{
					unset($model->preview);
				}

				if( $model->save() )
				{

					if( $model->preview )
					{
						/*
						if( $oldpreview )
						{
							@unlink('.'.Yii::app()->getModule('articles')->articlesDir.$oldpreview);	
						}
*/
						// оригинал
						$path = '.'.Yii::app()->getModule('articles')->articlesDir.$previewName;
		
						$model->_preview->saveAs($path);
		
		
						$image = Yii::app()->image->load($path);

						if( $image->width > 100 )// если ширина больше максимальной заданной, то уменьшимаем оригинал
						{
							$image->resize(100, NULL, Image::AUTO)->quality(100);
						}

						$image->save($path);
					}

					if( $id )
					{
						Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
				
						$this->redirect('/articles/'.$id.'.html');
					}
					else
					{
						Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Запись успеша добавлена');
				
						$this->redirect('/articles');
					}
				}
			}
		}

		$this->pageTitle = ($model->isNewRecord) ? 'Добавить статью' : 'Редактировать статью';

		$this->render('publication', array('model' => $model));
	}


    /**
     * Добавить комментарий
     */
	public function actionEditcomment()
	{
		$id = $_POST['pk'];

		$text = $_POST['value'];

		if( !$id or !$text )
		{
			return false;
		}

		$model = ArticlesComments::model()->findByPk($id);

		$model->text = $text;

		if( $model->validate() )
		{
			$model->save();
		}
	}

    /**
     * Добавить комментарий
     */
	public function actionAddComment()
	{
		$article_id = $_POST['article_id'];

		$article = Articles::model()->findByPk($article_id);

		if( !$article )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		$model = new ArticlesComments;

		if( Yii::app()->request->isPostRequest )
        {
			$model->setAttributes($_POST['ArticlesComments']);     
      
			if( $model->validate() )// +отправить письмо автору блога, если комментарий добавлен другим пользователем
            {
				$model->article_id = $article_id;

				$model->save();

				$article->saveCounters(array('comments' => 1));// прибавляем количество комментариев

				Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Комментарий добавлен');

				$this->redirect('/articles/'.$article_id.'.html#comment-'.$model->id);                   
			}
			else
			{
				Yii::app()->user->setFlash(FlashMessages::ERROR, $model->getError('text'));

				$this->redirect('/articles/'.$article_id.'.html#comments');   
			}
		}
	}

	public function actionJson()
	{
		//антикеширование
		header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

		if( isset($_GET['tag']) )
		{
			$criteria = new CDbCriteria(array(
				'limit' => 10
			));
         
			$criteria->addSearchCondition('name', $_GET['tag']);
 
			$tags = Tags::model()->findAll($criteria);            
 
			$this->renderPartial('json', array('tags' => $tags));
		}
	}
}