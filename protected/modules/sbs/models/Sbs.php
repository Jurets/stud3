<?php
class Sbs extends Model
{   //статусы сделки
	const STATUS_NEW = 4;// новая сделка
	const STATUS_ACTIVE = 1;// сумма зарезервирована
    const STATUS_REJECT = 8;//исполнитель отказался
    const STATUS_WAITRESERV = 7; //ждёт пополнения денег
    const STATUS_DONE = 9;    //исполнитель сдал работу (переходит на гарантию)
    const STATUS_DELAY = 10;    //сделка просрочена (исполнитель не сдал работу)
	const STATUS_COMPLETE = 2;// сделка завершена
	const STATUS_CLOSE = 3;// сделка отменена
	const STATUS_DISPUTE = 5;// возник спор, арбитраж

    const COMPLETE_ETA = 20; //сколько дней осталось до завершения сделки
    
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
    
    //показывает: есть ли у сделки сдача работы исполнителем (т.е. есть одна запись с типом = 1)
    public function isDeliver() {
        return isset($this->deliver);
    }
    
    //показывает: есть ли у сделки текущее требование от заказчика внести правки (соот-но исполнитель не выслал правки)
    public function isDemand() {
        $last_work = SbsWork::model()->findBySql('select * from {{sbs_work}} where sbs_id = :sbs_id order by id DESC limit 1', array(':sbs_id'=>$this->id));
        return is_object($last_work) && $last_work->type == SbsWork::TYPE_DEMAND;
    }

    //сколько дней осталось до завершения сделки (20 дней после сдачи работы)
    public function daysEtaComplete() {
        $daysGarantee = 0;
        $isDeliver = false;
        foreach($this->works as $work) {
            if ($work->type == SbsWork::TYPE_DELIVER || $work->type == SbsWork::TYPE_REWORK) {
                if (!$isDeliver) {
                    $isDeliver = true;
                    $dateB = $work->date;
                }
            } else if ($work->type == SbsWork::TYPE_DEMAND) {
                if ($isDeliver) {  //считаем только секунды между сдачей работы и внесением правок
                    $daysGarantee = $daysGarantee + $work->date - $dateB;
                    $isDeliver = false;
                    $dateB = null;
                }
            }
        }
        if ($isDeliver) {    // - это будет период нахождения на гарантии
            $daysGarantee = $daysGarantee + strtotime("now") - $dateB;
        }
        $diff = floor($daysGarantee/86400); //затем переводим в дни
        $days = self::COMPLETE_ETA - $diff;  //считаем - сколько осталось
        $days = $days < 0 ? 0 : $days;  //корректировка, если отрицательное число
        return $days;
    }    

    //сколько дней осталось до завершения сделки (20 дней после сдачи работы)
    public function getIsExpire() {//DebugBreak();
        if (!$this->isDeliver()) {//если НЕ БЫЛО сдачи работы
            $diff = floor((strtotime("now") - $this->date)/86400); //считаем разницу между сейчас и датой сделки (в днях)
            $days = $this->period - $diff;  //считаем - сколько осталось дней от заданного периода
            return ($days <= 0);  //возвращаем ИСТИНУ, если не осталось дней
        } else {
            return false;         //если была сдача работы - возвращаем ЛОЖЬ (т.е. не просрочена)
        }
    }
        
    /**
    * завершение сделки
    * 
    */
    public function complete()
    {
        $success = false;
        $this->status = self::STATUS_COMPLETE;
        if ($this->validate()) {
            $transaction = Yii::app()->db->beginTransaction();// начало транзакции
            try {
                $this->save();
                Balance_helper::change($this->performer_id, $this->amount, 'Платеж получен');
                //запись события
                new Events_helper($this->customer->id, $this->customer->id, Events_helper::NOTIFY_SBSCOMPLETE, $this->id);  //запись события
                //отсылка емейлов
                $userTo = $this->customer;
                Email_helper::send($userTo->email, 'Завершена сделка по проекту на сайте ' . Yii::app()->name . '', 'newSbsComplete', array('sbs'=>$this, 'userTo'=>$userTo));
                $userTo = $this->performer;
                Email_helper::send($userTo->email, 'Завершена сделка по проекту на сайте ' . Yii::app()->name . '', 'newSbsComplete', array('sbs'=>$this, 'userTo'=>$userTo));
                
                $transaction->commit();
                $success = true;
                //$this->redirect('/sbs');
            } catch(Exception $e) {
                $transaction->rollback();
                Yii::log("При завершении сделки возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
            }
        }
        return $success;
    }
 
    /**
    * завершение сделки
    * 
    */
    public function delay()
    {
        $success = false;
        $transaction = Yii::app()->db->beginTransaction();// начало транзакции
        try {
            $this->status = self::STATUS_DELAY;
            $this->save();
            //запись события
            new Events_helper($this->customer->id, $this->customer->id, Events_helper::NOTIFY_SBSDELAY, $this->id);  //запись события
            //отсылка емейлов
            Email_helper::send($this->performer->email, 'Вы не сдали работу в указанные сроки на сайте ' . Yii::app()->name . '', 'newSbsDelay', array(
                'sbs'=>$this, 'userTo'=>$this->performer,
            ));
            Email_helper::send($this->customer->email, 'Исполнитель не успел выполнить работу в указанные сроки на сайте ' . Yii::app()->name . '', 'newSbsDelayP', array(
                'sbs'=>$this, 'userTo'=>$this->customer,
            ));
            $transaction->commit();
            $success = true;
        } catch(Exception $e) {
            $transaction->rollback();
            Yii::log("При завершении сделки возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
        }
        return $success;
    }    
    
    /**
    * продление сделки
    * 
    */
    public function prolongation($date = null)
    {
        if (!isset($date)) {
            return false;
        }
        $success = false;
        $transaction = Yii::app()->db->beginTransaction();// начало транзакции
        try {
            $this->status = self::STATUS_ACTIVE;
            $this->period = floor(($date - $this->date)/86400);
            $this->save();
            //запись события
            new Events_helper($this->performer->id, $this->customer->id, Events_helper::NOTIFY_SBSPROLONGATION, $this->id);  //запись события
            //отсылка емейлов
            Email_helper::send($this->performer->email, 'Продление заказа на сайте ' . Yii::app()->name . '', 'newSbsProlongation', array(
                'sbs'=>$this, 'userTo'=>$this->performer,
            ));
            $transaction->commit();
            $success = true;
        } catch(Exception $e) {
            $transaction->rollback();
            Yii::log("При продлении сделки возникла ошибка! - ".$e->getMessage()."", CLogger::LEVEL_ERROR);  
        }
        return $success;
    }    
        
    /**
    * дата сдачи работы (в unix-формате)
    * 
    */
    public function getDateEnd() {
        return $this->date + $this->period * 86400;
    }
}