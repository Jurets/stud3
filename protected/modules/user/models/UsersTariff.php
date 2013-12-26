<?php
class UsersTariff extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{users_tariff}}';
	}

	/**
	* Получаем id пользователей чей тариф истек
	*/
	public function expiredTariffs()
	{
		return Yii::app()->db->createCommand()
			->select('*')
			->from('{{users_tariff}}')
			->where('period < :period and tariff = :tariff', array(':period' => time(), ':tariff' => Tariffs::PRO))
			->queryAll();
	}

	public function change($user_id)
	{
		return Yii::app()->db->createCommand()
			->update('{{users_tariff}}', array('period' => 0, 'tariff' => Tariffs::START), 'user_id=:user_id', array(':user_id' => $user_id));
	}
}