<?php
class UsersNotify extends Model
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{users_notify}}';
	}

    public function attributeLabels()
    {
        return array(
			'mailer' => 'Рассылка',
			'invite' => 'Приглашения',
			'blogs' => 'Блоги',
			'projects' => 'Удаленная работа',
			'items' => 'Каталог готовых работ',
			'messages' => 'Личные сообщения',
        );
    }

	public function rules()
	{
		return array(
			array('mailer, invite, blogs, projects, items, messages', 'numerical')
		);
	}
}