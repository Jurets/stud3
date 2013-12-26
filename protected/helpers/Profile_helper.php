<?php
class Profile_helper
{
	private $listing;

	const PHOTO = 1;
	const SKILLS = 2;
	const PORTFOLIO = 3;
	const SPECIALIZATIONS = 4;
	const RESUME = 5;
	const LOCATION = 6;
	
	function __construct()
	{
		$this->createList();
	}

	// Общий процент
	public function percent()
	{
		$count = 0;

		foreach ($this->listing as $row )
		{
			if( $row['check'] )
			{
				$count = $count + $row['perc'];
			}
		}
		
		return $count;
	}

    public function createList()
    {
		$this->listing = array(
			self::PHOTO => $this->get(self::PHOTO),
			self::SKILLS => $this->get(self::SKILLS),
			self::PORTFOLIO => $this->get(self::PORTFOLIO),
			self::SPECIALIZATIONS => $this->get(self::SPECIALIZATIONS),
			self::RESUME => $this->get(self::RESUME),
			self::LOCATION => $this->get(self::LOCATION),
        );
    }

    public function getListing()
    {
		return $this->listing;
    }

    public function get($id)// создаём массив, нужно название функции, процент
    {
		$array = array();


		$checks = $this->checks();

		$array['check'] = array_key_exists($id, $checks) ? $checks[$id] : false;


		$labels = $this->labels();

		$array['label'] = array_key_exists($id, $labels) ? $labels[$id] : false;


		$percentage = $this->percentage();

		$array['perc'] = array_key_exists($id, $percentage) ? $percentage[$id] : false;


		$links = $this->links();

		$array['link'] = array_key_exists($id, $links) ? $links[$id] : false;

		return $array;
    }

	// Метки
    public function labels()
    {
        return array(
			self::PHOTO => 'Добавьте фотографию',
			self::SKILLS => 'Добавьте навыки в профиле',
			self::PORTFOLIO => 'Добавьте работы в портфолио',
			self::SPECIALIZATIONS => 'Укажите специализации',
			self::RESUME => 'Заполните резюме',
			self::LOCATION => 'Укажите местоположение',
        );
    }

	// Проценты
    public function percentage()
    {
        return array(
			self::PHOTO => 15,
			self::SKILLS => 15,
			self::PORTFOLIO => 25,
			self::SPECIALIZATIONS => 15,
			self::RESUME => 20,
			self::LOCATION => 10,
        );
    }

	// Ссылки
    public function links()
    {
        return array(
			self::PHOTO => '/account/userpic',
			self::SKILLS => '/account/skills',
			self::PORTFOLIO => '/account/portfolio',
			self::SPECIALIZATIONS => '/account/services',
			self::RESUME => '/account/resume',
			self::LOCATION => '/account/profile',
        );
    }

	// Проверки
    public function checks()
    {
        return array(
			self::PHOTO => self::checkFoto(),
			self::SKILLS => self::checkSkills(),
			self::PORTFOLIO => self::checkPortfolio(),
			self::SPECIALIZATIONS => self::checkServices(),
			self::RESUME => self::checkResume(),
			self::LOCATION => self::checkLocation(),
        );
    }

	// Функции проверки

	public function checkFoto()
	{
		$photo = Yii::app()->db->createCommand()
			->select('userpic')
			->from('{{users}}')
			->where('id = :id', array(':id' => Yii::app()->user->id))
			->queryScalar();
			
		if( $photo == Yii::app()->getModule('user')->standartUserpic )
		{
			return FALSE;
		}
		
		return TRUE;
	}

	public function checkSkills()
	{
		return Yii::app()->db->createCommand()
			->select('interest')
			->from('{{users_interests}}')
			->where('user_id = :user_id', array(':user_id' => Yii::app()->user->id))
			->queryScalar();
	}

	public function checkServices()
	{
		return Yii::app()->db->createCommand()
			->select('user_id')
			->from('{{services}}')
			->where('user_id = :user_id', array(':user_id' => Yii::app()->user->id))
			->queryScalar();
	}

	public function checkPortfolio()
	{
		return Yii::app()->db->createCommand()
			->select('id')
			->from('{{portfolio}}')
			->where('user_id = :user_id', array(':user_id' => Yii::app()->user->id))
			->queryScalar();
	}

	public function checkResume()
	{
		return Yii::app()->db->createCommand()
			->select('full_descr')
			->from('{{users}}')
			->where('id = :id', array(':id' => Yii::app()->user->id))
			->queryScalar();
	}

	public function checkLocation()
	{
		return Yii::app()->db->createCommand()
			->select('country')
			->from('{{users}}')
			->where('id = :id', array(':id' => Yii::app()->user->id))
			->queryScalar();
	}
}