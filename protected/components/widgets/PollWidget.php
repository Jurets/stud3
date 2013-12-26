<?php
class PollWidget extends CWidget
{
    public function run()// если пользователь уже проголосовал, то выводим результаты
    {
		Yii::app()->getModule('polls');

		$poll = Polls::model()->findbyPk(1);

		if( !$poll )
		{
			return FALSE;
		}

		if( $poll->voted() )
		{
			$this->render('poll-results', $poll);
		}
		else
		{
			$this->render('poll', $poll);
		}
    } 
}