<?php
class SbsWork extends CActiveRecord
{
    const TYPE_DELIVER = 1;   //сдача работы
    const TYPE_DEMAND = 2;    //требование заказчика о внесении правок
    const TYPE_REWORK = 3;    //внесение правок исполнителем

    const STR_DELIVER = 'сдача работы';
    const STR_DEMAND = 'требование внести правки';
    const STR_REWORK = 'внесение правок';
    
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
        return '{{sbswork}}';
    }

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
            'sbs' => array(self::BELONGS_TO, 'Sbs', 'sbs_id'),
            'files' => array(self::HAS_MANY, 'SbsWorkFile', 'sbswork_id'),
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required'),
			array('sbs_id', 'safe')
		);
	}

	public function beforeSave()
    {
        if( $this->isNewRecord ) {
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
    
    private static function getTypeList()
    {
        return array(
            self::TYPE_DELIVER => self::STR_DELIVER,
            self::TYPE_DEMAND => self::STR_DEMAND,
            self::TYPE_REWORK => self::STR_REWORK,
       );
    }    
    
    public function getTypeStr()
    {
        $data = self::getTypeList();
        return array_key_exists($this->type, $data) ? $data[$this->type] : false;
    }
    
}