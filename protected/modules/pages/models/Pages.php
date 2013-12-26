<?php
class Pages extends Model
{
    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{pages}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	protected function beforeSave()
    {
		if( $this->isNewRecord )
		{
			$this->date = time();
		}


		return parent::beforeSave();
    }  

    public function attributeLabels()
    {
        return array(
			'name' => 'Название',
			'title' => 'Заголовок',
			'text' => 'Текст',
			'date' => 'Дата'
        );
    }

	public function rules()
	{
		return array(
			array('name, title, text', 'required')
		);
	} 
}