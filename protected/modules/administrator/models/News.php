<?php
class News extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{news}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	protected function beforeSave()
    {
		if( $this->isNewRecord )
		{
			$this->date = time();
		}


		return parent::beforeSave();
    }
}