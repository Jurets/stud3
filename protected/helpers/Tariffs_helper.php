<?php
class Tariffs_helper
{
    /**
     * Изменение тарифного плана
     */
	function changeTariff($user_id, $period)
	{
		$month = $period * 2629743;// умножаем на месяц

		// меняем тариф на PRO у польтзователя
		$user = User::model()->findbyPk($user_id);

		// меняем тариф и период в таблице
		$tariff = UsersTariff::model()->findbyPk($user_id);

		if( $user->tariff == Tariffs::PRO )// если продление
		{
			$tariff->period = $tariff->period + $month;
		}
		else
		{
			$tariff->tariff = Tariffs::PRO;

			$tariff->period = time() + $month;

			$user->tariff = Tariffs::PRO;

			$user->update();
		}

		$tariff->update();
	}

	function returnTariff()
	{
		$users = UsersTariff::expiredTariffs();

		if( !$users )
		{
			return FALSE;
		}

		$sql = "UPDATE {{users}} as t1 INNER JOIN {{users_tariff}} AS t2 ON t1.id = t2.user_id SET t1.tariff=1 WHERE t2.period < ".time()."";

		$command = Yii::app()->db->createCommand($sql);

		$command->execute();
	}
}