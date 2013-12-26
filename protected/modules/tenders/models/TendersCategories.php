<?php
class TendersCategories extends CActiveRecord
{
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
        return '{{categories}}';
    }

	public function relations()
	{
		return array(
			'parent' => array(self::BELONGS_TO, 'TendersCategories', 'parent_id', 'condition' => 'parent_id = 0'),
		);
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
		$query = self::model()->findAll();

		foreach( $query as $row )
		{
			$result[$row['parent_id']][$row['id']] = $row;
		}
		
		return $result;

	}
}