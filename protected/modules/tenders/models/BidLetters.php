<?php
class BidLetters extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{bids_letters}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
            'bid' => array(self::BELONGS_TO, 'Bids', 'bid_id'),
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required'),

			array('bid_id', 'safe')
		);
	}


	protected function beforeSave()
    {
		if( $this->isNewRecord )
		{
			$this->user_id = Yii::app()->user->id; 

			$this->date = time();

    		$this->text = htmlspecialchars($this->text);
		}

		return parent::beforeSave();
    }
}