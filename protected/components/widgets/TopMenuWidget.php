<?php
class TopMenuWidget extends CWidget
{
    public function run()
    {
		if( Yii::app()->user->isAuthenticated() )
		{
            $user = new User;
            $user = $user->with('static')->findbyPk(Yii::app()->user->id);
            
            $auctionCount = $user->bidCountAuction;
            $countClosed = Tenders::model()->user()->closed()->count();
            
            $arbitration = New Tenders();
            //!TODO - надо будет переделать - щас костыль!!!!!
            $countArbitration = $arbitration->user()->with(array('sbs'=>array('scopes'=>'disputed')))->count('sbs.status = :status');
            
            $this->controller->pageTitle = $user->usertype == User::USERTYPE_CUSTOMER? 'Кабинет заказчика' : 'Кабинет исполнителя';
            
            if ($user->usertype == User::USERTYPE_PERFORMER) {//DebugBreak();
                $offer = Sbs::model()->my()->offer();
                $offerCount = $offer->count();
                $workingCount = Sbs::model()->my()->active()->count(); 
                $declinedCount = 0; //заглушка
            } else {
                $offerCount = 0; 
                $workingCount = 0; 
                $declinedCount = 0; 
            }
            
            $this->render('topmenu', array(
                'user'=>$user, 
                //для всех
                'auctionCount'=>$auctionCount,
                'countClosed'=>$countClosed,
                'countArbitration'=>$countArbitration,
                //для исполнителя
                'offerCount'=>$offerCount,
                'workingCount'=>$workingCount,
                'declinedCount'=>$declinedCount,
            ));
		}
    } 
}