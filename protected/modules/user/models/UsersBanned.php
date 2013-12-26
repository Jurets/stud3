<?php
class UsersBanned extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{users_banned}}';
	}

	public function text($user_id)
	{
		return self::model()->findByPk($user_id)->descr;
	}

    public function attributeLabels()
    {
        return array(
			'date' => 'Дата',
			'descr' => 'Причина бана'
        );
    }
}