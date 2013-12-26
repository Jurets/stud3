<?php
class Notice extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{notice}}';
	}

	public function deleteServices()
	{
		Yii::app()->db->createCommand()
			->delete('{{notice}}', 'user_id = :user_id', array(':user_id' => Yii::app()->user->id));
	}

	public function getServices()
  	{
		$query = Yii::app()->db->createCommand()
			->select('category')
			->from('{{notice}}')
			->where('user_id = :user_id', array(':user_id' => Yii::app()->user->id))
			->queryAll();

		if( !$query ) return array();

		foreach($query as $row)
		{ 
			$array[] = $row['category'];
		}

		return $array;
  	}

    public function beforeSave()
    {        
		if( $this->isNewRecord )
		{
			$this->user_id = Yii::app()->user->id;  
		}

        return parent::beforeSave();     
    }
}