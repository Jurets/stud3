<?php
class ArticlesComments extends CActiveRecord
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
        return '{{articles_comments}}';
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

			array('name, article_id, parent_id', 'safe')
		);
	}

	public function beforeSave()
    {       
        if( $this->isNewRecord )
        {
            $this->date = time();

            $this->user_id = Yii::app()->user->id;

            $this->ip = Yii::app()->request->userHostAddress;

    		$this->text = htmlspecialchars($this->text);
        }
		else
		{
            $this->update = time();
		}

        return parent::beforeSave();
    }

    public function attributeLabels()
    {
        return array(
			'text' => 'Текст'
        );
    }

    public function afterFind()
    {
    	parent::afterFind();
    }
}