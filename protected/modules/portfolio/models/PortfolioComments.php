<?php
class PortfolioComments extends CActiveRecord
{
    const STATUS_NEED_CHECK = 0;
    const STATUS_APPROVED   = 1;
    const STATUS_SPAM       = 2;
    const STATUS_DELETED    = 3;

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
        return '{{portfolio_comments}}';
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

			array('name, portfolio_id', 'safe')
		);
	}

	public function beforeSave()
    {       
        if( $this->isNewRecord )
        {
            $this->date = time();

            $this->user_id = Yii::app()->user->id;

            $this->ip = Yii::app()->request->userHostAddress;
        }

        return parent::beforeSave();
    }

    public function scopes()
    {
        return array(
            'new' => array(
                'condition' => 'status = :status',
                'params' => array(':status' => self::STATUS_NEED_CHECK)
            ),
            'approved' => array(
                'condition' => 'status = :status',
                'params' => array(':status' => self::STATUS_APPROVED),
                'order' => 'creation_date DESC'
            )
        );
    }

    public function getStatusList()
    {
        return array(
            self::STATUS_APPROVED => Yii::t('comment', 'Принят'),
            self::STATUS_DELETED => Yii::t('comment', 'Удален'),
            self::STATUS_NEED_CHECK => Yii::t('comment', 'На проверке'),
            self::STATUS_SPAM => Yii::t('comment', 'Спам')
        );
    }

    public function getStatus()
    {
        $list = $this->getStatusList();

        return array_key_exists($this->status, $list) ? $list[$this->status]
            : Yii::t('comment', 'Статус неизвестен');
    }

    public function afterFind()
    {
    	parent::afterFind();

    	$this->date = date('d.m.Y H:m', $this->date);

    	$this->text = htmlspecialchars($this->text);
    }
}