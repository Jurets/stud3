<?php
class  Rating_helper
{
	const PORTFOLIO = 'portfolio';// добавлено работ

	const ITEMS = 'items';// добавлено товаров

	const RECDPOSREVIEW = 'recdposreview';// получено положительных отзывов

	const RECDNEGREVIEW = 'recdnegreview';// получено отрицательных отзывов

	const PURCHASED = 'purchased';// куплено товаров


	function change($param, $user_id = FALSE)
	{
		$minuses = array(self::RECDNEGREVIEW);// поля, которые идут в отрицательный рейтинг

		if( !$user_id )
		{
			$user_id = Yii::app()->user->id;
		}

		$model = UsersRating::model()->findByPk($user_id);

		$model->saveCounters(array($param => 1));


		$value = UsersRating::model()->getValue($param);

		$user = User::model()->findByPk($user_id);

		if( in_array($param, $minuses) )// минус
		{
			$user->saveCounters(array('rating' => -$value));
		}
		else
		{
			$user->saveCounters(array('rating' => $value));
		}
	}
}