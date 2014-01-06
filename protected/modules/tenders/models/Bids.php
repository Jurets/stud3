<?php
class Bids extends Model
{
	const STATUS_ACTIVE = 1;// активен
	const STATUS_ACCEPT = 2;// принят
	const STATUS_DECLINE = 3;// отлонен
	const STATUS_REJECT = 4;// отказался

	const PERIODBY_HOUR = 1;
	const PERIODBY_DAY = 2;
	const PERIODBY_MONTH = 3;

	const CURRENCY_RUB = 1;
	const CURRENCY_USD = 2;
	const CURRENCY_EURO = 3;

    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{bids}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function getStatusList()
	{
		return array(
			self::STATUS_ACTIVE    => 'Активен',
			self::STATUS_ACCEPT => 'Принят',
			self::STATUS_DECLINE => 'Отлонен',
			self::STATUS_REJECT => 'Отказался',
		);
	}

	public function getStatus()
	{
		$data = $this->getStatusList();

		return array_key_exists($this->status, $data) ? $data[$this->status] : '*неизвестно*';
	}

	public function getTenderCurrencyList()
	{
		return array(
			self::CURRENCY_RUB => 'Руб',
			self::CURRENCY_USD => 'USD',
			self::CURRENCY_EURO => 'Euro',
		);
	}

	public function getCurrencyList()
	{
		return array(
			self::CURRENCY_RUB => 'р',
			self::CURRENCY_USD => '$',
			self::CURRENCY_EURO => '&euro;',
		);
	}

	public function getCurrency()
	{
		$data = $this->getCurrencyList();

		return array_key_exists($this->currency, $data) ? $data[$this->currency] : '*неизвестно*';
	}

	public function getPeriodbyList()
	{
		return array(
			self::PERIODBY_HOUR => 'час',
			self::PERIODBY_DAY => 'день',
			self::PERIODBY_MONTH => 'месяц'
		);
	}

	public function getPeriodby()
	{
		$data = $this->getPeriodbyList();

		return array_key_exists($this->periodby, $data) ? $data[$this->periodby] : '*неизвестно*';
	}

	public function scopes()
	{
		return array(
			'active' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_ACTIVE)
			),
			'accepted' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_ACCEPT)
			),
			'declined' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_DECLINE)
			),
			'rejected' => array(
				'condition' => $this->getTableAlias().'.status = :status',
				'params'    => array(':status' => self::STATUS_REJECT)
			),
		);
	}

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
			'preview' => array(self::HAS_MANY, 'TendersPreview', 'bid_id'),
			'letters' => array(self::HAS_MANY, 'BidLetters', 'bid_id'),
			'count' => array(self::STAT, 'TendersPreview', 'bid_id'),
            'tender' => array(self::BELONGS_TO, 'Tenders', 'project_id'),
			'LettersCount' => array(self::STAT, 'BidLetters', 'bid_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
			'text' => 'Текст заявки',
			'budget_start' => 'Сумма от',
			'budget_end' => 'Сумма до'
        );
    }

	public function rules()
	{
		return array(
			array('text', 'required'),
			array('currency', 'currency'),
			array('periodby', 'periodby'),
			array('budget_start, budget_end, period_start, period_end', 'numerical')
		);
	}

	public function currency($attribute, $params)
	{
		if( $this->budget_start or $this->budget_end ) {
			if( !$this->currency ) {
				$this->addError('currency', 'Выберите валюту');
			}
		}
	}

	public function periodby($attribute, $params)
	{
		if( $this->period_start or $this->period_end ) {
			if( !$this->periodby ) {
				$this->addError('periodby', 'Выберите вид');
			}
		}
	}

	public function getMax()
	{
		$max = TendersPreview::MAX;
		if( $this->id ) {// если заявка существует, то проверяем сколько изображений уже загружено
			$max = $max - $this->count;
		}
		return $max;
	}

	public function period()
    {
		if( !$this->period_start && !$this->period_end ) return FALSE;
		if( $this->period_start ) {
			$period = 'от '.$this->period_start;
		}
		if( $this->period_end ) {
			$period .= ' до '.$this->period_end;
		}
		$period .= ' '.$this->getPeriodby();
		return $period;
	}

	public function budget()
    {
		if( !$this->budget_start && !$this->budget_end ) return FALSE;
		if( $this->budget_start ) {
			$budget = 'от '.$this->budget_start;
		}
		if( $this->budget_end ) {
			$budget .= ' до '.$this->budget_end;
		}
		$budget .= ' '.$this->getCurrency();
		return $budget;
	}

	protected function beforeSave()
    {
		if( $this->isNewRecord ) {
			$this->user_id = Yii::app()->user->id; 
			$this->status = self::STATUS_ACTIVE; 
			$this->date = time();
    		$this->text = htmlspecialchars($this->text);
		}
		return parent::beforeSave();
    }

	// количество новых заявок к проектам пользователя
	public function countNewBids()
	{
		return Yii::app()->db->createCommand()
			->select('COUNT({{bids}}.id) as count')
			->group('{{tenders}}.id')
			->join('{{bids}}', '{{bids}}.project_id = {{tenders}}.id')
			->from('{{tenders}}')
			->where('{{tenders}}.user_id = :user_id and {{bids}}.reading = :reading', array(':user_id' => Yii::app()->user->id, ':reading' => 0))
			->queryScalar();
	}
}