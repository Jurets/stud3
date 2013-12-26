<?php
class CommentController extends Controller
{
    /**
     * фильтры
     */
    public function filters()
    {
        return array(
			'ajaxOnly + add',// только ajax запросы
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
      
			if( $model->validate() )// отправить письмо автору портфолио, если не сам автор комментирует
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