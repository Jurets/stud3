<?php
class ChangePasswordForm extends CFormModel
{
    public $password;

    public $password2;

    public function rules()
    {
        return array(
            array('password, password2', 'required'),
            array('password, password2', 'length', 'min' => Yii::app()->getModule('user')->minPasswordLength, 'max' => Yii::app()->getModule('user')->maxPasswordLength),
            array('password', 'compare', 'compareAttribute' => 'password2', 'message' => 'Пароли не совпадают!')
        );
    }

    public function attributeLabels()
    {
        return array(
            'password'  => 'Новый пароль',
            'password2' => 'Повтор нового пароля',
        );
    }
}