<?php
class PerformanceFilter extends CFilter
{
    public function preFilter($filterChain)
    {

        return true;
//		if( Yii::app()->user->isAuthenticated() )
//		{
//			$user = User::model()->findbyPk(Yii::app()->user->id);// ���� ������������ �� �����������, �� �������������� �� ���������
//
//			if( $user->status == User::STATUS_NOT_ACTIVE )
//			{
//				$filterChain->controller->redirect('/activation');
//			}
//
//            return true;
//		}
//
//		$filterChain->controller->redirect(Yii::app()->user->loginUrl);
    }
}