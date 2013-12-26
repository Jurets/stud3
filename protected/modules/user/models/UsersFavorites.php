<?php
class UsersFavorites extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{users_favorites}}';
	}

	public function relations()
	{
		return array(
			'userdata' => array(self::BELONGS_TO, 'User', 'user_id'),
			'favoritedata' => array(self::BELONGS_TO, 'User', 'favorite'),
		);
	}

	public function check($favorite)
	{
		return Yii::app()->db->createCommand()
			->select('id')
			->from('{{users_favorites}}')
			->where('favorite = :favorite and user_id = :user_id', array(':favorite' => $favorite, ':user_id' => Yii::app()->user->id))
			->queryScalar();
	}

	public function beforeSave()
	{        
		if( $this->isNewRecord )
		{          
			$this->date = time();

			Static_helper::change(Static_helper::FAVORITES, $this->favorite);
		}
        
		return parent::beforeSave();     
	}

    protected function beforeDelete()
	{
		Static_helper::change(Static_helper::FAVORITES, $this->favorite, TRUE);

		return parent::beforeDelete();
	}
}