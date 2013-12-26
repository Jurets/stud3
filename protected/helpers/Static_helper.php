<?php
class Static_helper
{
	const PORTFOLIO = 'portfolio';

	const BLOGS = 'blogs';

	const FAVORITES = 'favorites';

	const ITEMS = 'items';

	const PROJECTS = 'projects';

	const FRIENDS = 'friends';

	const ReviewsPositive = 'reviews_positive';

	const ReviewsNegative = 'reviews_negative';

    public function getStatusList()
	{
		return array(
			self::PORTFOLIO => 'portfolio'
		);
	}

	public function getAccessLevel()
	{
		$data = $this->getAccessLevelsList();

		return array_key_exists($this->access_level, $data) ? $data[$this->access_level] : 'не найден';
    }

	function change($field, $user_id = FALSE, $minus = FALSE)
	{
		if( !$user_id )
		{
			$user_id = Yii::app()->user->id;
		}

		$model = UsersStatic::model()->findByPk($user_id);

		if( $minus )
		{
			$model->saveCounters(array($field => -1));
		}
		else
		{
			$model->saveCounters(array($field => 1));
		}
	}
}