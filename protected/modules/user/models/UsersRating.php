<?php
class UsersRating extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{users_rating}}';
	}

	public function getAllValue()
	{
		return Yii::app()->db->createCommand()
			->select('value')
			->from('{{rating}}')
			->queryAll();
	}

	public function getValue($param)
	{
		return Yii::app()->db->createCommand()
			->select('value')
			->from('{{rating}}')
			->where('param = :param', array(':param' => $param))
			->queryScalar();
	}

    public function attributeLabels()
    {
        return array(
			'auth' => 'Заходы на сайт',
			'portfolio' => 'Добавлено работ',
			'items' => 'Добавлено товаров',
			'balance' => 'Пополнено',
			'recdposreview' => 'Полученные положительные отзывы',
			'recdnegreview' => 'Полученные отрицательные отзывы',
			'purchased' => 'Куплено товаров'
        );
    }
}