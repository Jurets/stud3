<?php
/**
 * Model is the customized base model class.
 * All controller classes for this application should extend from this base class.
 */
class Model extends CActiveRecord
{
    const STR_UNKNOWN = '*неизвестно*';   //строка для вывода неизвестного значения для разных параметров
    
    //условия (скоуп) для ограничения выборки по текущему юзеру
    public function user($user_id = '')
    {
		if( !$user_id ) {
			$user_id = Yii::app()->user->id;
		}
        $this->getDbCriteria()->mergeWith(array(
            //'condition' => 'user_id='.$user_id,
            'condition' => $this->getTableAlias().'.user_id = :user_id',
            'params'=>array(':user_id'=>$user_id),
        ));
        return $this;
    }

	public function recently($limit=5)
	{
		$this->getDbCriteria()->mergeWith(array(
			'order'=>'date DESC'
		));
		return $this;
	}

	// переконвертированная дата
	public function date()
	{
		return Date_helper::date_smart($this->date);
	}
    
    protected function getSql() {
        return Yii::app()->db->createCommand();
    }
}