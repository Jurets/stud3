<?php

class Favorites_helper
{
	/**
	* проверка существования друга - если пользователь уже находится в списке друзей
	*/
	function check($id)
	{
		if( $model = UsersFavorites::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'favorite' => $id)) )
		{
			return $model;
		}
		
		return FALSE;
	}

	/*
	* Добавить в избранное
	*/
	function add($id)
	{
		if( self::check($id) )
		{
			self::remove($id);

			$result = array(
				'success' => array('remove' => TRUE)
			);

			return $result;
		}
		
		// создаем запрос
		$model = new UsersFavorites;

		$model->user_id = Yii::app()->user->id;

		$model->favorite = $id;
	
		$model->save();

		$result = array(
			'success' => array('add' => TRUE)
		);

		return $result;
	}

	/*
	* Удалить из избранного
	*/
	function remove($id)
	{
		$favorite = self::check($id);

		$favorite->delete();

		$result = array(
			'success' => array('remove' => TRUE)
		);

		return $result;
	}
}