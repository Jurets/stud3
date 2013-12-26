<?php
class Interests extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{interests}}';
	}
}