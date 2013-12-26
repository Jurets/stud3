<?php
class TopWidget extends CWidget
{
	public $specialization = FALSE;

    public function run()// если пользователь уже проголосовал, то выводим результаты
    {
		if( $specialization = $_POST['specialization'] )
		{
			if( array_key_exists($specialization, User::model()->getSpecializationList() ) )
			{
				$this->specialization = $specialization;
			}
		}

		if( $this->specialization == FALSE )// если не задан то берем случайный элемент
		{
			$this->specialization = array_rand(self::getTitleList());
		}

		$users = self::getTop($this->specialization);

		$title = self::getTitle();

		$this->render('top', array('title' => $title, 'users' => $users));
    }

	public function getTop($specialization)
  	{
		return Yii::app()->db->createCommand()
			->order('rating desc')
			->limit(5)
			->select('*')
			->from('{{users}}')
			->where('specialization = :specialization and status = :status', 
			  array(':specialization' => $specialization, ':status' => User::STATUS_ACTIVE))
			->queryAll();
  	}

	public function getTitleList()
	{
		return array(
			User::SPECIALIZATION_DEVELOPER => 'Топ Разработчиков',
			User::SPECIALIZATION_DESIGNER  => 'Топ Дизайнеров',
			User::SPECIALIZATION_COPYWRITER  => 'Топ Копирайтеров',
			User::SPECIALIZATION_SYSTEM  => 'Топ Системных администраторов',
		);
	}

	public function getTitle()
	{
		$data = $this->getTitleList();
		return array_key_exists($this->specialization, $data) ? $data[$this->specialization] : false;
    }
}