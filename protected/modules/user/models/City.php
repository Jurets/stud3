<?php
class City extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{city}}';
	}

	public function getNameById($id)
	{
		return $this->model()->findByPk($id)->name;
	}

	public function getByCountry($country_id)
	{
		return $this->model()->findAll('country_id = :country_id', array('country_id' => $country_id));
	}

	public function defaultScope()
    {
        return array(
            'order' => 'nums DESC, name ASC',
        );
    }
}