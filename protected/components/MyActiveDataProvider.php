<?php
class MyActiveDataProvider extends CActiveDataProvider
{
	public $pagination = array(
	'pageVar' => 'p',
	'pageSize' => 2,
	);

	public $sort = array(
	'sortVar' => 'v'
	);
}
