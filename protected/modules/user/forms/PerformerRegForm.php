<?php
class PerformerRegForm extends RegistrationForm
{
    const STEP_COUNT = 6;
    
    public $surname;
    public $country;
    public $city;
    
    public $telephone;
    public $educationplace;
    public $educationyear;
    
    public $specializations;
    
    public $is_cources;
    public $is_studentsworks;
    
    public $is_home;
    public $home_mapplace;
    public $home_pricehour;
    public $is_studenthome;
    public $studenthome_pricehour;
    public $is_weblearning;
    public $weblearning_pricehour;
    public $cources_forchild;
    public $cources_forschoolchild;
    public $cources_forstudents;
    public $cources_foradults;
    
    public $categories;

    public $step;       //шаг регистрации (1..6)

	/**
	* правила валидации
	*/
    public function rules()
    {
        return CMap::mergeArray(parent::rules(), array(
            array('surname', 'filter', 'filter' => 'trim'),// очищаем пробелы
            array('surname, country, city, telephone, educationplace, educationyear', 'required'),// обязательные поля
            array('surname', 'length', 'max' => 20),// фамилия, имя максимальная длина
            array('surname', 'match', 'pattern' => '/^[A-Za-zАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯабвгдеёжзийклмнопрстуфхцчшщьыъэюя0-9\s,]+$/', 
                  'message' => 'Неверный формат поля "{attribute}" допустимы только символы кириллицы и латиницы'),
            array('step, specializations', 'safe'), //безопасные поля
            array('is_cources, is_studentsworks, is_home, home_mapplace, home_pricehour, is_studenthome, studenthome_pricehour, is_weblearning, weblearning_pricehour', 'safe'), //безопасные поля
            array('cources_forchild, cources_forschoolchild, cources_forstudents, cources_foradults, categories', 'safe'), //безопасные поля
        ));
    }

    /**
    * метки
    */
    public function attributeLabels()
    {
        return CMap::mergeArray(parent::attributeLabels(), array(
            'is_cources' => 'Преподавать курсы',
            'is_studentsworks' => 'Выполнять написание работ для студентов',
            
            'is_home' => 'Принимать ученика у себя',
            'home_mapplace' => 'Выберите место на карте',
            'home_pricehour' => 'Стоимость академ. часа',
            'is_studenthome' => 'Выезжать к ученику на дом (в пределах города)',
            'studenthome_pricehour' => 'Стоимость академ. часа',
            'is_weblearning' => 'Удаленное обучение с помощью интернет',
            'weblearning_pricehour' => 'Стоимость академ. часа',
            'cources_forchild' => 'Для дошкольников',
            'cources_forschoolchild' => 'Для школьников',
            'cources_forstudents' => 'Для студентов',
            'cources_foradults' => 'Для взрослых',
            
        ));
    }

    //логика перехода по шагам ВПЕРЁД
    public function nextStep() {//DebugBreak();
        if ($this->step == self::STEP_COUNT) {
            return false;
        } else {
            if ($this->step == 3) {
                if ($this->is_cources)
                    $this->step = 4;
                else if ($this->is_studentsworks)
                    $this->step = 5;
                else
                    $this->step = 6;
            } else {
                $this->step = $this->step + 1;
            }
            return true;
        }
    }
}