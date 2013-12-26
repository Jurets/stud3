<?php
class History_helper
{  
	function add($user_id, $amount, $descr)
	{
		$event = new History;

		$event->user_id = $user_id;

		$event->amount = $amount;

		$event->descr = $descr;

		$event->save();
	}
}