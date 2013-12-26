<?php
class History extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{history}}';
	}

	protected function beforeSave()
    {
		if( $this->isNewRecord )// если новая запись
		{
			$this->date = time();
		}

		return parent::beforeSave();
    } 
}