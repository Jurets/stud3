<?php
class SetTariff extends CFormModel
{
    public $period;

	public function rules()
	{
		return array(
			array('period', 'required'),

			array('period', 'checkBalance'),
		);
	}

    public function checkBalance($attribute, $params)
    {
		$model = User::model()->findbyPk(Yii::app()->user->id);

		$tariff = Tariffs::model()->findbyPk(Tariffs::PRO);

		$amount = $tariff->price * $this->period;

		if( $amount > $model->balance )
		{    
            $this->addError('period', 'На вашем счету недостаточно средств');
		}
    }

	public function attributeLabels()
	{
		return array(
			'period' => 'Период'
		);
	}
}