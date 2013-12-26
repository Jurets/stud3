<?php
class Tariffs extends Model
{
    public $period;

	const START = 1;

	const PRO = 2;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{tariffs}}';
	}

	public function getPriceList()
	{
		return array(
			1 => $this->price,
			3 => $this->price3,
			6 => $this->price6,
			12 => $this->price12,
		);
	}

	public function getPrice($period)
	{
		$data = $this->getPriceList();

		return array_key_exists($period, $data) ? $data[$period] : false;
	}

	public function getAll()
	{
		$query = Yii::app()->db->createCommand()
			->select('*')
			->from('{{tariffs}}')
			->queryAll();

		if( !$query ) return array();

		foreach( $query as $row )
		{
			$result[$row['id']] = $row;
		}

		return $result;
	}

    public function attributeLabels()
    {
        return array(
			'name' => 'Название',
			'commission' => 'Комиссия при выводе средств',
			'sections' => 'Количество специализаций, по которым вы размещаетесь в каталоге',
			'catalog' => 'Размещение в каталоге пользователей выше остальных',
			'place' => 'Место на главной',
			'logo' => 'Загрузка логотипа компании',
        );
    }
}