<?php
class News extends Model
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

	public function rules()
	{
		return array(
			array('title, text', 'required'),

		);
	}
}