<?php
class MassForm extends CFormModel
{
	public $text;

	public function rules()
	{
		return array(
			array('text', 'required'),
		);
	}
}