<?php
class Perfomer extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{perfomers}}';
    }

    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'), //ссылка на пользователя
        );
    }

    public function rules()
    {
        return array(
            array('is_cources, is_studentsworks, is_home, home_mapplace, home_pricehour, is_studenthome, studenthome_pricehour, is_weblearning, weblearning_pricehour', 'safe'), //безопасные поля
            array('cources_forchild, cources_forschoolchild, cources_forstudents, cources_foradults', 'safe'), //безопасные поля
        );
    }

    public function beforeValidate()
    {
        //$this->username = $this->email;
        return parent::beforeValidate();
    }

    /**
     * Метки
     */
    public function attributeLabels()
    {
        return array(
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
        );
    }


}