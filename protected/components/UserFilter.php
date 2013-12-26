<?php
class UserFilter extends CFilter
{
	public $activation;// ���� ������������ �������������, �� �� ����� �������������

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
//		if( $this->activation == true )
//		{
//			return true;
//		}
//
//		$filterChain->controller->redirect(Yii::app()->user->loginUrl);
    }
}