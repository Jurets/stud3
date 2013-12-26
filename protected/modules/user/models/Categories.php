<?php
class Categories extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{categories}}';
	}

	public function scopes()
	{
		return array(
			'child' => array(
				'condition' => 'parent_id <> :parent_id',
				'params'    => array(':parent_id' => 0)
			),
		);
	}

	public function getCategories()
	{
		$categories = Yii::app()->db->createCommand()
			->select('*')
			->from('{{categories}}')
			->queryAll();

		foreach( $categories as $row )
		{
			$result[$row['parent_id']][$row['id']] = $row['name'];
		}

		return $result;
	}
}