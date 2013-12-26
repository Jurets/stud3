<?php
class AccessControl extends CFilter
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