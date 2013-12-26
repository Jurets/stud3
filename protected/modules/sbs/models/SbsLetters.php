<?php
class SbsLetters extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{sbs_letters}}';
    }

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required'),

			array('name,sbs_id', 'safe')
		);
	}

	public function beforeSave()
    {       
        if( $this->isNewRecord )
        {
            $this->date = time();

            $this->user_id = Yii::app()->user->id;

    		$this->text = htmlspecialchars($this->text);
        }

        return parent::beforeSave();
    }

    public function attributeLabels()
    {
        return array(
			'text' => 'Текст'
        );
    }
}