<?php
/**
 * Model is the customized base model class.
 * All controller classes for this application should extend from this base class.
 */
class Model extends CActiveRecord
{
    public function user($user_id = '')
    {
		if( !$user_id )
		{
			$user_id = Yii::app()->user->id;
		}

        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'user_id='.$user_id
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
}