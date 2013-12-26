<?php
class Country extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{country}}';
	}

	public function getNameById($id)
	{
		return $this->model()->findByPk($id)->name;
	}


	public function defaultScope()
    {
        return array(
            'order' => 'nums DESC, name ASC',
        );
    }

}