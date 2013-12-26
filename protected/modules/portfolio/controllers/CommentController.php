<?php
class CommentController extends Controller
{
    /**
     * �������
     */
    public function filters()
    {
        return array(
			'ajaxOnly + add',// ������ ajax �������
        );
    }

	public function actionAdd()
	{
		$model = new PortfolioComments;

		$id = $_POST['id'];
		
		$text = $_POST['text'];

		if( $id and $text )
        {
			$model->setAttributes(array(
				'portfolio_id' => $id,
				'text' => $text
			)); 
      
			if( $model->validate() )// ��������� ������ ������ ���������, ���� �� ��� ����� ������������
            {
				$model->save();    

				$result = array(
					'success' => TRUE,
					'username' => Yii::app()->user->getState('username'),
					'date' => Date_helper::date_smart(time()),
					'text' => htmlspecialchars($text)
				);
		
				echo json_encode($result);
			}
		}
	}
}