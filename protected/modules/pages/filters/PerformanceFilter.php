<?php
class PerformanceFilter extends CFilter
{
    public function preFilter($filterChain)
    {
		if( Yii::app()->user->isAuthenticated() )
		{ 
            return true;
		}

		$filterChain->controller->redirect(Yii::app()->user->loginUrl);
    }
}