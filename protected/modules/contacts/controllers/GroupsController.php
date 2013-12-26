<?php
class GroupsController extends Controller
{
    /**
     * Фильтры
     */
    public function filters()
    {
        return array(
			array('UserFilter')
        );
    }

    /**
     * Редактировать
     */
	function actionUpdate()
	{
		$id = $_POST['id'];

		$name = $_POST['name'];

		$model = Groups::model()->findByPk($id);
	
		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)) )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( Yii::app()->request->isPostRequest )
		{	
			$model->name = $name; 
				
			$model->save();  
	
			if( !$model->hasErrors() )
			{
				$result = array(
					'id' => $id,
					'name' => $name,
					'cont' => $model->countContacts,
				);
			}
			else// если есть ошибки, выводим
			{
				$result['error'] = $model->getError('name');
			}
				
			echo json_encode($result);
		}
	}

    /**
     * удалить
     */
	function actionDelete($id)
	{
		$model = Groups::model()->findByPk($id);

		if( !$model )
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( !Yii::app()->user->checkAccess('deleteContact', array('contact' => $model)))// доступ удалить
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		if( Contacts::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'group_id' => $id)) )
		{
			Yii::app()->user->setFlash(FlashMessages::INFO, 'Нельзя удалить не пустую группу');
			
			$this->redirect('/contacts/?group_id='.$id);
		}

		// удаляем группу
		$model->delete();

		Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Группа успеша удалена');

		$this->redirect('/contacts');
	}
}