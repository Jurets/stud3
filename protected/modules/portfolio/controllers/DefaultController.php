<?php
class DefaultController extends Controller
{
    /**
     * фильтры
     */
    public function filters()
    {
        return array(
			'ajaxOnly + show',// только ajax запросы
			array('UserFilter + publication, delete')
        );
    }

    /**
     * Просмотр - ajax
     */
	public function actionShow()
	{
		$id = $_POST['id'];
	
		$data = Portfolio::model()->findByPk($id);
	
		if( !$data )
		{    
			throw new CHttpException(404, 'The requested page does not exist.');
		}
	
		Portfolio::updateViews($id);


		// комментарии
		$criteria = new CDbCriteria;

		$criteria->condition = 'portfolio_id = :portfolio_id';
		
		$criteria->order = 'date desc';
		
		$criteria->params = array(':portfolio_id' => $id);

		$comments = PortfolioComments::model()->with('userdata')->findAll($criteria);


	
		$this->renderPartial('show', array('data' => $data, 'comments' => $comments));
	}

	public function actionPublication($id = '')
	{
		if( $id )// редактирование
		{
			$model = Portfolio::model()->findByPk($id);

			$oldpreview = $model->preview;// если будет замена

			if( !$model )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}
	
			if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)) )
			{
				throw new CHttpException(404, 'The requested page does not exist.');
			}
		}
		else// добавление
		{
			$model = new Portfolio;
		}

		if( Yii::app()->request->isPostRequest && !empty($_POST['Portfolio']) )
        {
			$model->setAttributes($_POST['Portfolio']);       

			$model->preview = CUploadedFile::getInstance($model, 'preview');

			if( $model->validate() )
            {
				if( $model->preview )
				{
					$extension = pathinfo($model->preview->getName(), PATHINFO_EXTENSION);

					$previewName = md5(time()).'.'.$extension;
	
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
						if( $oldpreview )
						{
							@unlink('.'.Yii::app()->getModule('portfolio')->portfolioDir.$oldpreview);	
						}

						$path = '.'.Yii::app()->getModule('portfolio')->portfolioDir.$previewName;
	
						$model->_preview->saveAs($path);
	

						$image = Yii::app()->image->load($path);


						if( $image->width > Portfolio::MAXWIDTH )// если ширина больше максимальной заданной, то уменьшимаем оригинал
						{
							$image->resize(Portfolio::MAXWIDTH, NULL, Image::AUTO)->quality(100);
						}
	
	
						$image->save();
					}

					if( $id )
					{
						Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Изменения успешно сохранены');
			
						$this->redirect('/account/portfolio');
					}
					else
					{
						Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Работа успешна добавлена');
			
						$this->redirect('/account/portfolio');
					}
				}
			}
		}

		$categories =  Portfolio::getCategories();// категории

		$this->pageTitle = 'Добавить работу';

		$this->render('publication', array('model' => $model, 'categories' => $categories));
	}

    /**
     * Удалить
     */
	function actionDelete($id)
	{
		$model = Portfolio::model()->findByPk($id);
	
		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}
	
		if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)))
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		// удаляем
		$model->delete();

		// portfolio_like и portfolio_views удалить
		@unlink('.'.Yii::app()->getModule('portfolio')->portfolioDir.$model->preview);// удаляем изображение

		Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Работа успеша удалена');

		$this->redirect('/account/portfolio');
	}

    /**
     * Показать в каталоге
     */
	public function actionMain()
	{
		$id = $_POST['id'];

		$checked = $_POST['checked'];

		if( $id )
		{
			if( $checked )
			{
				if( Portfolio::countMain() >= Portfolio::MAX_MAIN )
				{
					$result = array(
						'error' => 'Максимальное количество работ в каталоге: '.Portfolio::MAX_MAIN.''
					);
				}
			}

			if( $result['error'] )
			{
				echo json_encode($result);
				
				Yii::app()->end();
			}

			if( $checked == TRUE )
			{
				Portfolio::changeMain($id);
			}
			else
			{
				Portfolio::deleteMain($id);
			}

			$result = array(
				'success' => TRUE
			);
		}

		echo json_encode($result);
	}

    /**
     * нравится - ajax
     */
	public function actionLike()
	{
		if( !Yii::app()->user->isAuthenticated() )
		{
			$result = array(
				'error' => array('noaccess' => TRUE)
			);
		
			echo json_encode($result);
			
			Yii::app()->end();
		}

		$id = $_POST['id'];

		if( $id )
		{
			if( !Portfolio::checkLike($id) )
			{
				Portfolio::updateLike($id);
				
				$result = array(
					'success' => TRUE
				);
			
				echo json_encode($result);
			}
		}
	}
}