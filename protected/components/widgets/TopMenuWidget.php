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
            //$countClosed = Tenders::model()->user()->closed()->count();
            
            //!TODO - надо будет переделать - щас костыль!!!!!
            //$arbitration = New Tenders();
            //$countArbitration = $arbitration->user()->with(array('sbs'=>array('scopes'=>'disputed')))->count('sbs.status = :status');

            //и для заказчика и для исполнителя
            $workingCount = Sbs::model()->my()->active()->count();
            $guaranteeCount = Sbs::model()->my()->guarantee()->count();
            $countArbitration = Sbs::model()->my()->disputed()->count();
            $completedCount = Sbs::model()->my()->disputed()->completed()->count();
            $closedCount = Sbs::model()->my()->disputed()->closed()->count();
            
            if ($user->usertype == User::USERTYPE_PERFORMER) {
                $offer = Sbs::model()->my()->offer();
                $offerCount = $offer->count();
                $declinedCount = 0; //заглушка
            } else {
                $offerCount = 0; 
                //$workingCount = 0; 
                $declinedCount = 0; 
            }
            
            $this->controller->pageTitle = $user->usertype == User::USERTYPE_CUSTOMER? 'Кабинет заказчика' : 'Кабинет исполнителя';
            $this->render('topmenu', array(
                'user'=>$user, 
                //для всех
                'auctionCount'=>$auctionCount,
                'countArbitration'=>$countArbitration,
                //для исполнителя
                'offerCount'=>$offerCount,
                'workingCount'=>$workingCount,
                'declinedCount'=>$declinedCount,
                'guaranteeCount'=>$guaranteeCount,
                'completedCount'=>$completedCount,
                'closedCount'=>$closedCount,
            ));
		}
    } 
}