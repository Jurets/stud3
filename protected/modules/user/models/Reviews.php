<?php
class Reviews extends Model
{
	// тип отзыва
	const REVIEW_POSITIVE = 1;// положительный
	const REVIEW_NEGATIVE = -1;// отрицательный

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{reviews}}';
	}

	public function relations()
	{
		return array(
			'userdata' => array(self::BELONGS_TO, 'User', 'from_id'),
		);
	}

	public function scopes()
	{
		return array(
			'positive' => array(
				'condition' => 'mark = :mark',
				'params'    => array(':mark' => self::REVIEW_POSITIVE)
			),
			'negative' => array(
				'condition' => 'mark = :mark',
				'params'    => array(':mark' => self::REVIEW_NEGATIVE)
			),
		);
	}

    public function attributeLabels()
    {
        return array(
			'date' => 'Дата',
			'update' => 'Дата обновления',
			'text' => 'Текст',
			'mark' => 'Тип'
        );
    }

	public function rules()
	{
		return array(
			array('text, mark', 'required')
		);
	}

    public function beforeSave()
    {        
		if( $this->isNewRecord )
		{
			$this->from_id = Yii::app()->user->id;  
      
			$this->date = time();

			if( $this->mark == self::REVIEW_POSITIVE )
			{
				Static_helper::change(Static_helper::ReviewsPositive, $this->user_id);

				Rating_helper::change(Rating_helper::RECDPOSREVIEW, $this->user_id);
			}
			elseif( $this->mark == self::REVIEW_NEGATIVE )
			{
				Static_helper::change(Static_helper::ReviewsNegative, $this->user_id);

				Rating_helper::change(Rating_helper::RECDNEGREVIEW, $this->user_id);
			}

		}
		else
		{
			$this->update = time();
		}

        return parent::beforeSave();     
    }
}