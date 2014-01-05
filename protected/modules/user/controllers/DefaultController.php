<?php
class DefaultController extends Controller
{
    
    
    public function filters()
    {
        return array(
            'ajaxOnly + geolocation'
        );
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class'     => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'foreColor' => 0x3a87ad,
                'testLimit' => 10
            )
        );
    }

    /**
     * Служба поддержки
     */
    public function actionSupport()
    {
        $form = new SupportForm;

        if (Yii::app()->request->isPostRequest && !empty($_POST['SupportForm'])) {
            $form->setAttributes($_POST['SupportForm']);

            if ($form->validate()) {
                Email_helper::send('openweblife@gmail.com', 'Сообщение для службы поддержки', 'support', array('data' => $form));


                Yii::app()->user->setFlash(FlashMessages::INFO, 'Сообщение отправлено');

                $this->refresh();
            }
        }

        $this->pageTitle = 'Служба поддержки';

        $this->render('support', array('model' => $form));
    }

    /**
     * Геолокация
     */
    public function actionGeolocation()
    {
        $id = $_POST['id'];

        if (Yii::app()->request->isPostRequest && $id) {
            $cities = City::model()->findAll('country_id = :country_id', array(':country_id' => $id));

            if (!empty($cities)) {
                echo "out.options[out.options.length] = new Option('выберите город...','');\n";

                foreach ($cities as $city) {
                    echo "out.options[out.options.length] = new Option('" . $city['name'] . "','" . $city['city_id'] . "');\n";
                }
            } else {
                echo "out.options[out.options.length] = new Option('нет городов','');\n";
            }
        }
    }

    /**
    * Регистрация исполнителя
    * 
    */
    public function actionRegistration2()
    {//DebugBreak();
        //throw new CHttpException("404", '<div class="alert alert-error">Извините регистрация только по <a href="/registration/invite">приглашению</a>. Приглашение можете получить у друзей которые уже зарегистрированы у нас или <a href="/support">написать администрации</a> чем Вы будете полезны для сервиса если получите приглашение. Приглашения ни когда не продавались и не будут продаваться, если Вам кто то предлагает его купить, известите пожалуйста нас об этом. Всем кто будет замечен в продаже приглашений будет бессрочно заблокирован доступ на сайт.</div>');
        if (Yii::app()->user->isAuthenticated()) {
            $this->redirect(Yii::app()->getModule('user')->loginSuccess);
        }
        if (Yii::app()->user->hasState('userPerformer')) {//DebugBreak();
            $sform = Yii::app()->user->getState('userPerformer');
            //$form = unserialize($sform);
            $form = new PerformerRegForm;
            $form->setAttributes($sform);
        } else {
            $form = new PerformerRegForm;
            $form->step = 1;
        }
        //если есть пришедшие данные с формы
        if (Yii::app()->request->isPostRequest && !empty($_POST['PerformerRegForm'])) {
            $form->setAttributes($_POST['PerformerRegForm'], false);
            if ($form->validate()) 
            {
                $form->nextStep();       //следующий шаг регистрации
                if ($form->step >= PerformerRegForm::STEP_COUNT)
                {
                    $transaction = Yii::app()->db->beginTransaction();
                    try { //запись в таблицу юзеров
                        $user = new User;
                        $user->setScenario('onRegistration');
                        //$user->setAttributes($form->attributes, false);
                        //$success = $user->save(false);
                        //$success = $user->createAccount($form->attributes);
                        $success = $user->createPerformer($form->attributes);
                        if ($success) {  //запись в связанную таблицу исполнителей
                            $perfomer = new Perfomer;
                            $perfomer->setAttributes($form->attributes, false);
                            $perfomer->user_id = $user->id;
                            $success = $perfomer->save(false);
                            if ($success) {  //сохранить специализации
                                foreach($form->specializations as $item) {
                                    Yii::app()->db->createCommand()->insert('ci_performer_specializations', array(
                                        'performer_id'=>$perfomer->id,
                                        'specialization_id'=>$item,
                                    ));
                                } //сохранить категории
                                foreach($form->categories as $item) {
                                    Yii::app()->db->createCommand()->insert('ci_performer_categories', array(
                                        'performer_id'=>$perfomer->id,
                                        'category_id'=>$item,
                                    ));
                                }
                            }
                        }
                        
                        //if ($user && $success && !$user->hasErrors()) {
                        if ($success) {
                            $transaction->commit();    //подтвердить транзакцию
                            Yii::app()->user->setState('userPerformer', null); //стереть сессию
                            
                            Yii::log("Создана учетная запись " . $user->username . "!", CLogger::LEVEL_INFO);
                            //Email_helper::send($user->email, 'Регистрация на ' . Yii::app()->name . '', 'needActivation', array('data' => $user));
                            //Yii::app()->user->setFlash(FlashMessages::INFO, 'Регистрация успешно завершена, проверьте почту');
                            // автоматический вход
                            $identity = new UserIdentity($form->username, $form->password);
                            $identity->authenticate();
                            Yii::app()->user->login($identity);
                            //$this->redirect('/activation');   //не редиректим на активацию (?)
                        } else {
                            $transaction->rollBack();
                            Yii::log("Ошибка при создании  учетной записи!", CLogger::LEVEL_ERROR);
                        }
                    } catch (Exception $e) {
                        $transaction->rollback();
                        Yii::log("При регистрации произошла ошибка!", CLogger::LEVEL_ERROR);
                        $form->addError('username', $e->getMessage() . 'При регистрации пользователя произошла ошибка!');
                    }
                } else {//DebugBreak();
                    //$sform = serialize($form);
                    $sform = $form->attributes;
                    Yii::app()->user->setState('userPerformer', $sform);
                }
                //$form->nextStep();
            }
        } else {
            $form->step = 1;
        } 
        $this->pageTitle = 'Регистрация';
        $this->render('registration' . $form->step, array('model' => $form));
    }

    /**
     * Регистрация
     */
    public function actionRegistration()
    {
        //throw new CHttpException("404", '<div class="alert alert-error">Извините регистрация только по <a href="/registration/invite">приглашению</a>. Приглашение можете получить у друзей которые уже зарегистрированы у нас или <a href="/support">написать администрации</a> чем Вы будете полезны для сервиса если получите приглашение. Приглашения ни когда не продавались и не будут продаваться, если Вам кто то предлагает его купить, известите пожалуйста нас об этом. Всем кто будет замечен в продаже приглашений будет бессрочно заблокирован доступ на сайт.</div>');
        if (Yii::app()->user->isAuthenticated()) {
            $this->redirect(Yii::app()->getModule('user')->loginSuccess);
        }
        $form = new RegistrationForm;
        if (Yii::app()->request->isPostRequest && !empty($_POST['RegistrationForm'])) {//DebugBreak();
            $form->setAttributes($_POST['RegistrationForm']);
            if ($form->validate()) {
                $transaction = Yii::app()->db->beginTransaction();

                try {
                    $user = new User;
                    $user->setScenario('onRegistration');
                    $data = array(
                        'username' => $form->username,
                        'email'    => strtolower($form->email),
                        'password' => $form->password,
                        'name'     => $form->name,
                        'gender'   => $form->gender
                    );

                    $user->createAccount($data);

                    if ($user && !$user->hasErrors()) {
                        Yii::log("Создана учетная запись " . $user->username . "!", CLogger::LEVEL_INFO);

                        Email_helper::send($user->email, 'Регистрация на ' . Yii::app()->name . '', 'needActivation', array('data' => $user));
                        $transaction->commit();
                        //Yii::app()->user->setFlash(FlashMessages::INFO, 'Регистрация успешно завершена, проверьте почту');
                        // автоматический вход
                        $identity = new UserIdentity($form->username, $form->password);
                        $identity->authenticate();
                        Yii::app()->user->login($identity);
                        $this->redirect('/activation');
                    } else {
                        $transaction->rollBack();
                        Yii::log("Ошибка при создании  учетной записи!", CLogger::LEVEL_ERROR);
                    }
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::log("При регистрации произошла ошибка!", CLogger::LEVEL_ERROR);
                    $form->addError('username', $e->getMessage() . 'При регистрации пользователя произошла ошибка!');
                }
            }
        }
        $this->pageTitle = 'Регистрация';
        $this->render('registration', array('model' => $form));
    }

    /**
     * Выход
     */
    public function actionLogout()
    {
        Yii::log('Пользователь ' . Yii::app()->user->getState('username') . ' вышел', CLogger::LEVEL_INFO);
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->getModule('user')->logoutSuccess);
    }

    /**
     * Авторизация
     */
    public function actionLogin()
    {
        if (Yii::app()->user->isAuthenticated()) {
            $this->redirect(Yii::app()->getModule('user')->loginSuccess);
        }

        $form = new LoginForm;

        if (Yii::app()->request->isPostRequest && !empty($_POST['LoginForm'])) {
            $form->setAttributes($_POST['LoginForm']);

            if ($form->validate()) {
                Yii::log('Пользователь ' . $form->username . ' авторизовался!', CLogger::LEVEL_INFO);

                $redirect = (Yii::app()->user->isSuperUser()) ? '/administrator/default/pages' : '/users/' . $form->username;

                $this->redirect('/account/profile');
            } else {
                Yii::log('Ошибка авторизации! email => ' . $form->username . ', password => ' . $form->password . '!', CLogger::LEVEL_ERROR);
            }
        }

        $this->pageTitle = 'Авторизация';

        $this->render('login', array('model' => $form));
    }

    /**
     * Восстановление пароля
     */
    public function actionRecovery()
    {
        $form = new RecoveryForm;

        if (Yii::app()->request->isPostRequest && isset($_POST['RecoveryForm'])) {
            $form->setAttributes($_POST['RecoveryForm']);

            if ($form->validate()) {
                $user = $form->getUser();

                $recovery = new RecoveryPassword;

                $recovery->setAttributes(array(
                    'user_id' => $user->id,
                    'code'    => $recovery->generateRecoveryCode($user->id)
                ));

                if ($recovery->save()) {
                    // отправить письмо с сылкой на сброс пароля
                    Yii::log('Заявка на автоматическое восстановление пароля.', CLogger::LEVEL_INFO);

                    Yii::app()->user->setFlash(FlashMessages::INFO, 'Запрос на восстановление забытого логина или пароля для e-mail ' . $user->email . ' отправлен на e-mail');

                    Email_helper::send($user->email, 'Запрос на восстановление забытого логина или пароля - ' . Yii::app()->name . '', 'recovery', array('data' => $user, 'recovery' => $recovery));


                    $this->redirect(Yii::app()->getModule('user')->loginUrl);
                } else {
                    Yii::log('Ошибка при создании заявки на автоматическое восстановление пароля', CLogger::LEVEL_ERROR);

                    Yii::app()->user->setFlash(FlashMessages::ERROR, 'При восстановлении пароля произошла ошибка! Повторите попытку позже!!!');

                    $this->redirect(Yii::app()->getModule('user')->recoveryUrl);
                }

            }
        }

        $this->pageTitle = 'Восстановление пароля';

        $this->render('recovery', array('model' => $form));
    }

    /**
     * Сброс пароля
     */
    public function actionRecoveryPassword($code = '')
    {
        if (!$code) {
            Yii::app()->user->setFlash(FlashMessages::ERROR, 'Код восстановления пароля не найден! Попробуйте еще раз!');

            $this->redirect(Yii::app()->getModule('user')->recoveryUrl);
        }

        $recovery = RecoveryPassword::model()->with('user')->find('code = :code', array(':code' => $code));

        if (!$recovery) {
            Yii::log('Код восстановления пароля ' . $code . ' не найден!', CLogger::LEVEL_ERROR);

            Yii::app()->user->setFlash(FlashMessages::ERROR, 'Код восстановления пароля не найден! Попробуйте еще раз!');

            $this->redirect(Yii::app()->getModule('user')->recoveryUrl);
        }

        $newPassword = User::model()->generateRandomPassword();

        $recovery->user->password = User::model()->hashPassword($newPassword);

        $transaction = Yii::app()->db->beginTransaction(); // начинаем транзакцию

        try {
            if ($recovery->user->save() && RecoveryPassword::model()->deleteAll('user_id = :user_id', array(':user_id' => $recovery->user->id))) {
                $transaction->commit(); // конец транзакции

                Email_helper::send($recovery->user->email, 'Временный пароль на ' . Yii::app()->name . '', 'recoverySuccess', array('data' => $recovery->user, 'password' => $newPassword));

                Yii::app()->user->setFlash(FlashMessages::INFO, 'Новый пароль отправлен Вам на email!');

                Yii::log('Успешное восстановление пароля!', CLogger::LEVEL_ERROR);

                $this->redirect(Yii::app()->getModule('user')->loginUrl);
            }
        } catch (CDbException $e) {
            $transaction->rollback(); // если ошибка, откатываем изменения

            Yii::app()->user->setFlash(FlashMessages::ERROR, 'Ошибка при смене пароля!');

            Yii::log('Ошибка при автоматической смене пароля ' . $e->getMessage() . '!', CLogger::LEVEL_ERROR);

            $this->redirect(Yii::app()->getModule('user')->recoveryUrl);
        }
    }

    public function actionConfirmation($code = '')
    {
        Yii::app()->getModule('tenders');
        $tender = Tenders::model()->find('hash = :hash', array(':hash' => $code));
        if ($tender !== null) {
            if ($tender->status == Tenders::STATUS_MODERATION) {
                $tender->status = Tenders::STATUS_OPEN;
                $tender->update();
                $user = User::model()->findByPk($tender->user_id);
                if ($user) {
                    $user->activate();
                    Email_helper::send($user->email, 'Активация проекта на ' . Yii::app()->name . '', 'tenderActivation', array('data' => $user, 'tender' => $tender));
                }
            }
			$this->redirect(array('/activated','id'=>$tender->user_id));
            // $this->render('activated',array('tender'=>$tender));
        } else {
            throw new CHttpException(404);
        }
    }

    /**
     * Активация
     */
    public function actionActivation($code = '', $action = '')
    {
        Yii::app()->getModule('tenders');

        $form = new ActivationForm;
		$tenders  = new Tenders();

        $user = User::model()->find('activation_code = :activation_code', array(':activation_code' => ($action == '') ? $code : Yii::app()->user->id));

        if ($action == 'send') {
            Email_helper::send($user->email, 'Активация учетной записи на ' . Yii::app()->name . '', 'needActivation', array('data' => $user));
            Yii::app()->user->setFlash(FlashMessages::SUCCESS, 'Код активации отправлен.');

            $this->redirect('/activation');
        }

        if (Yii::app()->request->isPostRequest && isset($_POST['ActivationForm']) or $code) {
            if ($code) {
                $form->code = $code;
            } else {
                $form->setAttributes($_POST['ActivationForm']);
            }

            if ($form->validate()) {
                // процедура активации
                if ($user->activate()) {
                    Tenders::model()->getModerated($user->id);
                    Yii::log("Активирован аккаунт с activate_key = " . $code . "!", CLogger::LEVEL_INFO);
					
					$this->redirect(array('/activated','id'=>$user->id));
                    // $tender = $tenders->getLastTenderByUserId($user->id);
                    // $this->render('activated',array('tender'=>$tender));
                } else {
                    Yii::app()->user->setFlash(FlashMessages::ERROR, 'При активации аккаунта произошла ошибка! Попробуйте позже!');

                    Yii::log("При активации аккаунта c activate_key = " . $key . " произошла ошибка!", CLogger::LEVEL_ERROR);
                }
            }
        } 
		
		$this->pageTitle = 'Активация учетной записи';
		$this->render('activation', array('model' => $form, 'user' => $user));
    }
	
	public function actionActivated($user_id)
    {
        Yii::app()->getModule('tenders');
        $tenders  = new Tenders();
        $tender = $tenders->getLastTenderByUserId($user_id);
        $this->render('activated',array('tender'=>$tender));
    }

    /**
     * Все пользователи
     */
    public function actionIndex($category = '', $specialization = '')
    {
        Yii::app()->getModule('portfolio');

        $model = User::model()->active()->with('static');

        if (Yii::app()->user->isAuthenticated()) // если авторизирован
        {
            $search = UsersSearch::model()->user()->find();;

            if ($_GET['action'] == 'delete') // удаляем фильтр
            {
                $search->status = UsersSearch::STATUS_OFF;

                $search->save();

                $this->redirect('/users');
            }

            if ($_GET['action'] == 'apply') {
                $search->status = UsersSearch::STATUS_ON;

                $search->save();

                $this->redirect('/users');
            }

            if ($search->interests) {
                $interests = explode(", ", $search->interests); // для вывода
            }

            $model->cat($search);

            if (Yii::app()->request->isPostRequest && !empty($_POST['UsersSearch'])) {
                $search->setAttributes($_POST['UsersSearch']);

                if ($search->validate()) {
                    $search->save();

                    $this->refresh();
                }
            }
        }


        $criteria = new CDbCriteria;

        if ($category) {
            $category = Categories::model()->child()->findByPk((int)$category);

            if ($category) {
                $criteria->addCondition('`id` IN (SELECT user_id FROM {{services}} WHERE `category` IN (:category) )');

                $criteria->params[':category'] = $category->id;
            }
        }

        if ($specialization) {
            if (array_key_exists($specialization, User::model()->getSpecializationList())) {
                $criteria->condition = 'specialization = :specialization';

                $criteria->params[':specialization'] = (int)$specialization;
            } else {
                $specialization = '';
            }
        }

        $dataProvider = new CActiveDataProvider($model, array(
            'criteria'   => $criteria,
            'sort'       => array(
                'sortVar'      => 's',
                'defaultOrder' => array(
                    'rating' => true
                ),
                'attributes'   => array(
                    'rating',
                    'static.reviews_positive'
                )
            ),
            'pagination' => array(
                'pageVar'  => 'p',
                'pageSize' => 20,
            ),
        ));

        $renderdata = array(
            'dataProvider'   => $dataProvider,
            'category'       => $category,
            'specialization' => $specialization,
            'search'         => $search,
            'interests'      => (isset($interests)) ? $interests : false
        );

        $this->pageTitle = 'Все пользователи';

        $this->render('index', $renderdata);
    }

    /**
     * мерчант webmoney
     */
    function actionResult()
    {
        header('Content-Type: text/html; charset=utf-8');
        $LMI_PREREQUEST = $_POST['LMI_PREREQUEST'];

        $LMI_PAYMENT_AMOUNT = $_POST['LMI_PAYMENT_AMOUNT']; //Сумма платежа

        $LMI_PAYEE_PURSE = $_POST['LMI_PAYEE_PURSE']; //Кошелек продавца

        $LMI_PAYMENT_NO = $_POST['LMI_PAYMENT_NO']; //Внутренний номер покупки продавца

        $LMI_MODE = $_POST['LMI_MODE']; //Флаг тестового режима

        $LMI_SYS_INVS_NO = $_POST['LMI_SYS_INVS_NO']; //Внутренний номер счета в системе WebMoney Transfer

        $LMI_SYS_TRANS_NO = $_POST['LMI_SYS_TRANS_NO']; //Внутренний номер платежа в системе WebMoney Transfer

        $LMI_SYS_TRANS_DATE = $_POST['LMI_SYS_TRANS_DATE']; //Дата и время выполнения платежа

        $LMI_PAYER_PURSE = $_POST['LMI_PAYER_PURSE']; //Кошелек покупателя

        $LMI_PAYER_WM = $_POST['LMI_PAYER_WM']; //WMId покупателя


        $purse = 'R951805365035';

        $user_id = $_POST['user_id'];

        $order_id = $_POST['LMI_PAYMENT_NO'];

        $secret_key = '73YWIIEj9zXPRftfqcaaP80sG3Anq9XJdfl6Gh6ebvAisoVgXA';

        $common_string = $LMI_PAYEE_PURSE . $LMI_PAYMENT_AMOUNT . $LMI_PAYMENT_NO .
            $LMI_MODE . $LMI_SYS_INVS_NO . $LMI_SYS_TRANS_NO .
            $LMI_SYS_TRANS_DATE . $secret_key . $LMI_PAYER_PURSE . $LMI_PAYER_WM;


        $hash = strtoupper(md5($common_string));


        if ($LMI_PREREQUEST == 1) {
            if ($LMI_PAYEE_PURSE != $purse) {
                $err = 1;
                echo "ERR: Неверный кошелек получателя";
                exit;
            }

            if (!$err) echo "YES";
        } else {
            $LMI_HASH = $_POST['LMI_HASH'];

            if ($hash != $LMI_HASH) {
                echo "ERR: Параметры указаны неверно";
                exit;
            };


            Balance_helper::change($user_id, $LMI_PAYMENT_AMOUNT, 'Пополнение баланса');

            /*
                        $data = array (
                            'id' => $order_id,
                            'user_id' => $user_id,
                            'amount' => $LMI_PAYMENT_AMOUNT
                        );

                        $this->account_mdl->add('orders', $data);
            */
        }
    }
}