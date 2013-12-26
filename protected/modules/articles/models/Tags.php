<?php
class Tags extends CActiveRecord
{
	public function tableName()
	{
		return '{{tags_for_articles}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}