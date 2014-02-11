<?php
class Sbs extends Model
{
	const STATUS_NEW = 4;// новая сделка
	const STATUS_ACTIVE = 1;// сумма зарезервирована
	const STATUS_COMPLETE = 2;// сделка завершена
	const STATUS_CLOSE = 3;// сделка отменена

	const STATUS_DISPUTE = 5;// возник спор, арбитраж
    
    const STATUS_WAITRESERV = 7; //ждёт пополнения денег
    const STATUS_REJECT = 8;//исполнитель отказался
    const STATUS_DONE = 9;    //исполнитель сдал работу (переходит на гарантию)

	public function tableName()
	{
		return '{{sbs}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	protected function beforeSave()
    {
		if( $this->isNewRecord ) {// если новая запись
			$this->customer_id = Yii::app()->user->id;  
			$this->status = self::STATUS_NEW;
			$this->date = time();
		}
		return parent::beforeSave();
    }

    public function attributeLabels()
    {
        return array(
			'period' => 'Сроки',
			'amount' => 'Сумма'
        );
    }

	public function getStatusList()
	{
		return array(
			self::STATUS_NEW    => 'Новая',
			self::STATUS_ACTIVE => 'Зарезервирована',
			self::STATUS_COMPLETE => 'Завершена',
			self::STATUS_CLOSE => 'Отменена',
		);
	}

	public function getStatus()
	{
		$data = $this->getStatusList();
		return array_key_exists($this->status, $data) ? $data[$this->status] : '*неизвестно*';
	}

    public function relations()
    {
        return array(
            'customer' => array(self::BELONGS_TO, 'User', 'customer_id'),
            'performer' => array(self::BELONGS_TO, 'User', 'performer_id'),
            'arbitration' => array(self::HAS_ONE, 'SbsArbitration', 'sbs_id'),
            'project' => array(self::BELONGS_TO, 'Tenders', 'project_id'),
            'letters' => array(self::HAS_MANY, 'SbsLetters', 'sbs_id'),
            'works' => array(self::HAS_MANY, 'SbsWork', 'sbs_id'),
            'deliver' => array(self::HAS_ONE, 'SbsWork', 'sbs_id', 'condition'=>'type = '.SbsWork::TYPE_DELIVER),
        );
    }

	public function rules()
	{
		return array(
			array('performer_id', 'required', 'message'  => 'Выберите исполнителя'),
			array('period, amount', 'required')
		);
	}

	public function scopes()
	{
		return array(
			'my' => array(
				'condition' => $this->getTableAlias().'.customer_id = :user_id or '.$this->getTableAlias().'.performer_id = :user_id',
				'params'    => array(':user_id' => Yii::app()->user->id)
			),
			'renewed' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_NEW)
			),
			'active' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_ACTIVE)
			),
			'completed' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_COMPLETE)
			),
			'closed' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_CLOSE)
			),
            'disputed' => array(
                'condition' => $this->getTableAlias().'.status = :status',
                'params'    => array(':status' => self::STATUS_DISPUTE)
            ),

            'offer' => array(
                'condition' => $this->getTableAlias().'.status = :status1 OR ' . $this->getTableAlias().'.status = :status2',
                'params'    => array(':status1' => self::STATUS_NEW, ':status2' => self::STATUS_WAITRESERV)
            ),
            'guarantee' => array(
                'condition' => $this->getTableAlias().'.status = :status',
                'params'    => array(':status' => self::STATUS_DONE)
            ),
		);
	}
    
    //показывает: есть ли в у сделки сдача работы исполнителем (т.е. есть одна запись с типом = 1)
    public function isDeliver() {
        return isset($this->deliver);
    }
}