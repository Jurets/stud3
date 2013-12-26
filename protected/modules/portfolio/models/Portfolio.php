<?php
class Portfolio extends Model
{
    const MAXWIDTH = 700;

    const MAIN = 1;

    const MAX_MAIN = 3;// максимальное количество главных работ

	public $_file; // атрибут для хранения загружаемого юзерпика

	public $_preview; // атрибут для хранения загружаемого юзерпика

    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{portfolio}}';
	}

	public function getCategories()
	{
		return Yii::app()->db->createCommand()
			->select('*')
			->from('{{portfolio_categories}}')
			->queryAll();
	}

	/**
	* Обновление просмотров
	* @param $id записи
	*/
	public function updateViews($id)
	{
		if( Portfolio::checkView($id) )
		{
			return false;		
		}

		Yii::app()->db->createCommand()
			->insert('ci_portfolio_views', array('portfolio_id' => $id, 'user_id' => Yii::app()->user->id, 'ip' => Yii::app()->request->userHostAddress));

		$sql = "UPDATE ci_portfolio SET `views` = `views` + 1 WHERE `id` = :id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':id', $id);
		$command->execute();
	}

	public function checkView($id)
	{
		return Yii::app()->db->createCommand()
			->select('portfolio_id')
			->from('ci_portfolio_views')
			->where('portfolio_id=:id and (user_id=:user_id or ip=:ip)', array(':id' => $id, ':user_id' => Yii::app()->user->id, ':ip' => Yii::app()->request->userHostAddress))
			->queryScalar();
	}

	/**
	* обновление
	* @param $id записи
	*/
	public function updateLike($id)
	{
		Yii::app()->db->createCommand()
			->insert('ci_portfolio_like', array('portfolio_id' => $id, 'user_id' => Yii::app()->user->id));

		$sql = "UPDATE ci_portfolio SET `like` = `like` + 1 WHERE `id` = :id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':id', $id);
		$command->execute();
	}

	public function checkLike()
	{
		if( !Yii::app()->user->isAuthenticated() )
		{
			return FALSE;
		}

		return Yii::app()->db->createCommand()
			->select('portfolio_id')
			->from('ci_portfolio_like')
			->where('portfolio_id = :id and user_id = :user_id', array(':id' => $this->id, ':user_id' => Yii::app()->user->id))
			->queryScalar();
	}

	public function relations()
    {
        return array(
            'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
			'comments' => array(self::STAT, 'PortfolioComments', 'portfolio_id')
        );
    }

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	protected function beforeSave()
    {
		if( $this->isNewRecord )// если новая запись
		{
			$this->user_id = Yii::app()->user->id;  

			$this->date = time();// дата добавление

			Static_helper::change(Static_helper::PORTFOLIO);

			Rating_helper::change(Rating_helper::PORTFOLIO);
			
			if( self::countMain() < self::MAX_MAIN )
			{
				$this->main = self::MAIN;// дата добавление	
			}
		}

		return parent::beforeSave();
    }  

    protected function beforeDelete()
	{
		PortfolioComments::model()->deleteAll('portfolio_id = :portfolio_id', array(':portfolio_id' => $this->id));

		Static_helper::change(Static_helper::PORTFOLIO, $this->user_id, TRUE);

		return parent::beforeDelete();
	}

    public function attributeLabels()
    {
        return array(
			'title' => 'Заголовок',
			'category' => 'Категория',
			'text' => 'Описание',
			'preview' => 'Превью',
			'file' => 'Работа'
        );
    }
	
	public function rules()
	{
		return array(
			array('title, text, category', 'required'),

			array('title', 'form_validation', 'rule' => 'nospecial'),

			array('text','filter','filter'=>'htmlspecialchars'),

            array('title', 'length', 'max' => 128),

			array('preview', 'required', 'on'=>'insert', 'message' => 'Укажите файл для загрузки'),

            array('preview', 'file', 'on' => 'insert',
                'types'=> 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 10, // 10MB                
                'tooLarge' => 'The file was larger than 10MB. Please upload a smaller file.',                
            ),

            array('preview', 'file', 'on' => 'update',
                'allowEmpty' => true,
                'types'=> 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 10, // 10MB                
                'tooLarge' => 'The file was larger than 10MB. Please upload a smaller file.',                
            ),

            array('main', 'safe'),
		);
	}

	public function countMain()
	{
		return self::model()->count('user_id = :user_id and main = :main', array(':user_id' => Yii::app()->user->id, ':main' => self::MAIN));
	}

	public function changeMain($id)
	{
		return Yii::app()->db->createCommand()
			->update('{{portfolio}}', array('main' => self::MAIN), 'id=:id', array(':id' => $id));
	}

	public function deleteMain($id)
	{
		return Yii::app()->db->createCommand()
			->update('{{portfolio}}', array('main' => 0), 'id=:id', array(':id' => $id));
	}

	function getTop($user_id, $limit = 3)
  	{
		return Yii::app()->db->createCommand()
			->limit($limit)
			->select('*')
			->from('{{portfolio}}')
			->where('user_id = :user_id and main = :main', array(':user_id' => $user_id, ':main' => self::MAIN))
			->queryAll();
  	}
}