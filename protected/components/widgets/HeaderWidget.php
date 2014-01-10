<?php
class HeaderWidget extends CWidget
{
    public function run()
    {
		if( Yii::app()->user->isAuthenticated() )
		{
			/*Yii::app()->getModule('contacts');
			Yii::app()->getModule('tenders');
			$user = new User;
			$user = $user->with('static')->findbyPk(Yii::app()->user->id);
			$data['user'] = $user;
			$messages = new Messages;
			$bids = new Bids;
			$data['countMessage'] = $messages->count('reading = :reading and recipient_id = :recipient_id', array('reading' => 0, 'recipient_id' => Yii::app()->user->id));
			// новые заявки к проектам
			$data['countNewBids'] = Bids::countNewBids();
			$this->render('menu', $data);*/
            
            $user = new User;
            $user = $user->with('static')->findbyPk(Yii::app()->user->id);
            $auctionCount = $user->bidCountAuction;
            $this->render('header', array('auctionCount'=>$auctionCount));
		}
    } 
}