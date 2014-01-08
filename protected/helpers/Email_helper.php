<?php
class Email_helper {

	public static function send($email, $subject, $view, $data, $file = '')
	{
		if( !$email ) {
			return FALSE;
		} else if ( $email == 'webtail@mail.ru' ) {
			return FALSE;
		}
		$message = new YiiMailMessage;
		$message->view = $view;
		$message->setBody($data, 'text/html');
		$message->subject = $subject;
		//$message->setSubject($subject);
		$message->addTo($email);
		$message->setFrom(array(Yii::app()->params['adminEmail'] => 'Fnetwork.ru'));
		if( !empty($file) ) {
			$message->attach(Swift_Attachment::fromPath($_SERVER['DOCUMENT_ROOT'].$file));
		}
		return Yii::app()->mail->send($message);
	}

}