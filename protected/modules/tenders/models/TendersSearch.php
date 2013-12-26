<?php
class TendersSearch extends Model
{
	const STATUS_ON = 1;
	const STATUS_OFF = 2;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{tenders_search}}';
	}

	public function rules()
	{
		return array(
			array('keywords, price_start, price_end, country, city, favorite', 'safe')
		);
	}

	public function beforeSave()
	{   
		if( $this->isNewRecord )// если новая запись
		{

		}
		else// если изменение
		{
			if( $categories = $_POST['categories'] )
			{
				$serialize = serialize($categories); 
				
				$this->categories = $serialize;
			}
		}
		
		return parent::beforeSave();
	}

    public function afterFind()
    {
    	$this->categories = unserialize($this->categories);
		
		if( !is_array($this->categories) )
		{
			$this->categories = array();
		}
    }
}