<?php
class UsersSearch extends Model
{
	const STATUS_ON = 1;
	const STATUS_OFF = 2;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{users_search}}';
	}

	public function rules()
	{
		return array(
			array('keywords, username, price_start, price_end, age_start, age_end, expertise_start, expertise_end, favorite, portfolio, reviews, interests', 'safe')
		);
	}

	public function beforeSave()
	{        
		if( $interests = $_POST['Tags'] )
		{
			$interests = implode($interests, ", ");
						
			$this->interests = $interests;
		}
		else
		{
			$this->interests = '';
		}
        
		return parent::beforeSave();     
	}
}