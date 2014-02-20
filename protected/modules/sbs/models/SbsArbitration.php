<?php
class SbsArbitration extends Model
{
	const STATUS_CLS = 5;// средства возвращены заказчику

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{sbs_arbitration}}';
	}

    public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
			'date' => 'Дата',
			'text' => 'Текст'
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required')
		);
	}

	protected function beforeSave()
    {
		if( $this->isNewRecord ) {// если новая запись
			$this->user_id = Yii::app()->user->id;  
			$this->date = time();
		}
		return parent::beforeSave();
    }
}