<?php
class Tenders extends Model
{
    const TYPE_PROJECT = 1;
    const TYPE_TENDER  = 2;
    const TYPE_VACANCY = 3;

    const STATUS_OPEN       = 1;
    const STATUS_CLOSE      = 2;
    const STATUS_MODERATION = 3;
    const STATUS_TRASH      = 5;

    const STATUS_ENDED = 4; // конкурс завершен

    const PRICEBY_HOUR    = 1;
    const PRICEBY_DAY     = 2;
    const PRICEBY_MONTH   = 3;
    const PRICEBY_PROJECT = 4;

    const CURRENCY_RUB  = 1;
    const CURRENCY_USD  = 2;
    const CURRENCY_EURO = 3;
    
    public $notify;
	public $tender_id;

    //public $percent = 90; //временно
    public $spec;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{tenders}}';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Закрываем завершившиеся тендеры
     */
    public function closeTenders()
    {
        return Yii::app()->db->createCommand()
                             ->update('{{tenders}}', array('status' => self::STATUS_ENDED), 'date_end < :time and type = :type', array(':time' => time(), ':type' => self::TYPE_TENDER));
    }

    public function getTypeList()
    {
        return array(
            self::TYPE_PROJECT => 'Проект',
            self::TYPE_TENDER  => 'Конкурс',
            self::TYPE_VACANCY => 'Вакансия',
        );
    }

    //получить тип работы
    public function getType() {
        $data = $this->getTypeList();
        return array_key_exists($this->type, $data) ? $data[$this->type] : self::STR_UNKNOWN;
    }

    public function getPricebyList()
    {
        return array(
            self::PRICEBY_HOUR    => 'час',
            self::PRICEBY_DAY     => 'день',
            self::PRICEBY_MONTH   => 'месяц',
            self::PRICEBY_PROJECT => 'проект'
        );
    }

    public function getPriceby()
    {
        $data = $this->getPricebyList();
        return array_key_exists($this->priceby, $data) ? $data[$this->priceby] : self::STR_UNKNOWN;
    }

    public function getTenderCurrencyList()
    {
        return array(
            self::CURRENCY_RUB  => 'Руб',
            self::CURRENCY_USD  => 'USD',
            self::CURRENCY_EURO => 'Euro',
        );
    }

    public function getCurrencyList()
    {
        return array(
            self::CURRENCY_RUB  => 'р',
            self::CURRENCY_USD  => '$',
            self::CURRENCY_EURO => '&euro;',
        );
    }

    public function getCurrency()
    {
        $data = $this->getCurrencyList();
        return array_key_exists($this->currency, $data) ? $data[$this->currency] : self::STR_UNKNOWN;
    }

    public function getStatusList()
    {
        return array(
            self::STATUS_OPEN       => 'Открыт',
            self::STATUS_CLOSE      => 'Закрыт',
            self::STATUS_MODERATION => 'На модерации',
        );
    }

    public function getStatus() {
        $data = $this->getStatusList();
        return array_key_exists($this->status, $data) ? $data[$this->status] : self::STR_UNKNOWN;
    }

    public function relations()  {
        return array(
            'userdata'      => array(self::BELONGS_TO, 'User', 'user_id'),
            'tendercategory'=> array(self::BELONGS_TO, 'TendersCategories', 'category'),
            'tenderspeciality'=> array(self::BELONGS_TO, 'TendersSpeciality', 'speciality'),
            'bidslist'      => array(self::HAS_MANY, 'Bids', 'project_id'),
            'winner'        => array(self::HAS_ONE, 'Bids', 'project_id', 'condition' => 'status=' . Bids::STATUS_ACCEPT),
            'BidCount'      => array(self::STAT, 'Bids', 'project_id'),
            'ActiveCount'   => array(self::STAT, 'Bids', 'project_id', 'condition' => 'status=' . Bids::STATUS_ACTIVE),
            'DeclinedCount' => array(self::STAT, 'Bids', 'project_id', 'condition' => 'status=' . Bids::STATUS_DECLINE),
            'AcceptedCount' => array(self::STAT, 'Bids', 'project_id', 'condition' => 'status=' . Bids::STATUS_ACCEPT),
            'RejectedCount' => array(self::STAT, 'Bids', 'project_id', 'condition' => 'status=' . Bids::STATUS_REJECT),
        );
    }

    public function scopes() {
        return array(
            'opened'  => array(
                'condition' => 'status = :status',
                'params'    => array(':status' => self::STATUS_OPEN)
            ),
            'closed'  => array(
                'condition' => 'status = :status',
                'params'    => array(':status' => self::STATUS_CLOSE)
            ),
            'project' => array(
                'condition' => 'type = :type',
                'params'    => array(':type' => self::TYPE_PROJECT)
            ),
            'tender'  => array(
                'condition' => 'type = :type',
                'params'    => array(':type' => self::TYPE_TENDER)
            ),
            'vacancy' => array(
                'condition' => 'type = :type',
                'params'    => array(':type' => self::TYPE_VACANCY)
            )
        );
    }

    /**
    * условие (скоуп): заказы в аукционе
    * 
    */
    public function auction()
    {//DebugBreak();
        $criteria = New CDbCriteria;
        $criteria->addInCondition('status', array(self::STATUS_OPEN/*, Bids::STATUS_ACCEPT*/));
        $criteria->order = 'status ASC, date DESC';
        
        //$this->getDbCriteria()->scopes = 'user';
//        $this->getDbCriteria()->addInCondition('status', array(self::STATUS_OPEN, Bids::STATUS_ACCEPT));
//        $this->getDbCriteria()->order = 'status ASC, date DESC';
        
        //$criteria->scopes = 'opened';
        //$criteria->addCondition('not exists(select id from {{bids}} where {{bids}}.project_id = ' . $this->tableAlias . '.id and status = :status)');
        //$criteria->params = array(':status' => Bids::STATUS_ACCEPT);
        $this->getDbCriteria()->mergeWith( $criteria
            //array(
            //'condition'=>'not exists(select id from {{bids}} where {{bids}}.project_id = ' . $this->tableAlias . '.id and status = :status)',
            //'condition'=>'not exists(select id from {{bids}} where {{bids}}.project_id = ' . $this->tableAlias . '.id and status = :status)',
            //'params'=>array(':status' => Bids::STATUS_ACCEPT),
            //)
        );
        return $this;
    }    
    
    /**
     * Проверка на существование заявки (от текущего юзера) в проекте (возвращается ИД ответа)
     */
    public function checkBid()
    {
        return Yii::app()->db->createCommand()
                             ->select('id')
                             ->from('{{bids}}')
                             ->where('project_id = :id and user_id = :user_id', array(':id' => $this->id, ':user_id' => Yii::app()->user->id))
                             ->queryScalar();
    }

    /**
     * Проверка на существование ПРИНЯТОЙ заявки в проекте (возвращается модель)
     */
    public function checkABid()
    {
        return Bids::model()->find('project_id = :project_id and status = :status', array(':project_id' => $this->id, ':status' => Bids::STATUS_ACCEPT));
    }

    public function attributeLabels() {
        return array(
            'title'    => 'Тема работы',
            'category' => 'Категория',
            'text'     => 'Текст заявки',
            'budget'   => 'Бюджет',
            'percent'  => 'Процент на Антиплагиате',
            'pages'    => 'Кол-во страниц',
            'day'      => 'Срок сдачи',
            'font'     => 'Размер шрифта',
            'file'     => 'Добавление файлов',
            'spec'     => 'Специализация',
            'speciality'=> 'Специализация',
        );
    }

    public function rules() {
        return array(
            array('title, text, category', 'required'),
            array('speciality', 'required', 'on'=>'insert'),
            array('budget, pages, font', 'numerical'),
            array('status, notify, priceby, descr, agreement, type, country, city, date_start, date_end, speciality, percent', 'safe'),
        );
    }


    public function Category() {
        return TendersCategories::model()->findByPk($this->category)->name;
    }

    public function getModerated($user = '')
    {
        $tender = self::model()->find('user_id = :user_id and status =  :status', array(':user_id' => ($user == '') ? Yii::app()->user->id : $user, ':status' => self::STATUS_MODERATION));
        if (!$tender)
            return false;
        $tender->status = self::STATUS_OPEN;
        $tender->update();
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            if (!isset($this->user_id))
                $this->user_id = Yii::app()->user->id;
            $this->date = time();
            //Static_helper::change(Static_helper::PROJECTS);
        } else {
            $this->update = time();
        }
        $this->descr = Text_helper::character_limiter($this->text, 500);
        return parent::beforeSave();
    }

    // прочитать заявки
    public function readingBids()
    {
        return Yii::app()->db->createCommand()
                             ->update('{{bids}}', array('reading' => time()), 'project_id = :project_id', array(':project_id' => $this->id));
    }

    // количество непрочитанных заявок
    public function checkNewBids()
    {
        return Yii::app()->db->createCommand()
                             ->select('id')
                             ->from('{{bids}}')
                             ->where('project_id = :project_id and reading = :reading', array(':project_id' => $this->id, 'reading' => 0))
                             ->queryScalar();
    }

    function getList($limit = 5)
    {
        return Yii::app()->db->createCommand()
                             ->order('date desc')
                             ->limit($limit)
                             ->select('{{tenders}}.*')
                             ->from('{{tenders}}')
                             ->where('bids = :bids and status = :status', array('bids' => 0, 'status' => self::STATUS_OPEN))
                             ->queryAll();
    }
	
	function getLastTenderByUserId($user_id)
    {
        $model = Tenders::model()->find(array(
            'condition' => 'user_id=:user_id',
            'params' => array(':user_id'=>$user_id),
            'order' => 'id DESC',
            'limit' => 1,
        ));
        return $model;
    }
    
    /**
    * дата в широком (развёрнутом) формате
    * 
    */
    public function getDateLong() {
        if ($this->date)
            $str = Yii::app()->dateFormatter->formatDateTime($this->date, 'long', null);
        else
            $str = self::STR_UNKNOWN;
        return $str;
    }

    public function getDateEndMedium() {
        if ($this->date_end)
            $str = Yii::app()->dateFormatter->formatDateTime($this->date_end, 'medium', null);
        else
            $str = self::STR_UNKNOWN;
        return $str;
    }
    
    /**
    * строка специализации
    * 
    */
    public function getSpecialityString() {
        return isset($this->tenderspeciality) ? $this->tenderspeciality->name : self::STR_UNKNOWN;
    }
    
    //
    public function adminlink() {
        if( $this->bids > 0 ) {
            return $this->bids.' предложений';
        } else {
            return 'Нет предложений';
        }
    }
}