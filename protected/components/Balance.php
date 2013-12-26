<?php
class Balance extends CApplicationComponent 
{
	private $_model;
	
	public $a;

	public function init()
	{
		parent::init();

		$this->_model = User::model()->findbyPk(Yii::app()->user->id);
		
		$this->_model->balance = $this->_model->balance + 1;
		
		//$this->_model->update(array('balance'));


		//User::model()->updateByPk(1,array('lastLogin'=>date('Y-m-d H:i:s')));
	}

	public function plus()
	{
		
		//$this->_model->update(array('balance'));


		//User::model()->updateByPk(1,array('lastLogin'=>date('Y-m-d H:i:s')));
	}
}