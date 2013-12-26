<?php
class Balance_helper
{  
	function change($user_id, $amount, $descr = '')
	{
		if( !$user_id )
		{
			$user_id = Yii::app()->user->id;
		}

		$user = User::model()->findByPk($user_id);

		$user->saveCounters(array('balance' => $amount));

		if( $descr )
		{
			History_helper::add($user_id, $amount, $descr);
		}
	}
}