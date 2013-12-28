<?php
class MainController extends Controller
{
    public function filters()
    {
        return array(
            'ajaxOnly + messages, events, top', // только ajax запросы
        );
    }

    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;

        if ($error) {
            $this->pageTitle = Yii::app()->name . ' - ' . $error['code'];

            $this->render('error', array('error' => $error));
        } else {
            throw new CHttpException(404, 'Page not found.');
        }
    }

    public function actionMessages()
    {
        Yii::app()->getModule('contacts');

        if ($id = $_POST['id']) {
            $message = Messages::model()->findByPk($id);

            $message->notification = 1;

            $message->save();

            Yii::app()->end();
        }

        $messages = new Messages;

        $msg = $messages->count('reading = :reading and recipient_id = :recipient_id', array('reading' => 0, 'recipient_id' => Yii::app()->user->id));


        if ($msg > 0) {

            $data = array(
                'success' => true,
                'msg'     => $msg
            );

            echo CJSON::encode($data);

            Yii::app()->end();
        } else {
            $result = array(
                'error' => true
            );
        }

        echo json_encode($result);
    }

    public function actionEvents()
    {
        if ($id = $_POST['id']) {
            $event = Events::model()->findByPk($id);

            $event->status = Events::STATUS_CLOSE;

            $event->save();

            Yii::app()->end();
        }

        $data['events'] = Yii::app()->db->createCommand()
                                        ->select('{{events}}.*, username, userpic')
                                        ->join('{{users}}', '{{users}}.id = {{events}}.object')
                                        ->from('{{events}}')
                                        ->where('user_id = :user_id and {{events}}.status = :status', array('user_id' => Yii::app()->user->id, 'status' => Events::STATUS_OPEN))
                                        ->queryAll();


        if ($data) {
            echo CJSON::encode($data);
        } else {
            $result = array(
                'error' => true
            );

            echo json_encode($result);
        }
    }

    public function actionTop()
    {
        $this->widget('TopWidget');
    }

    protected function createUser($form)
    {
        $user = new User;

        $user->setScenario('onRegistration');

        $password = substr(md5(uniqid(mt_rand(), true) . time()), 0, 5);

        $data = array(
            'type'     => User::TYPE_CUSTOMER,
            'username' => strtolower($form->email),
            'email'    => strtolower($form->email),
            'password' => $password,
        );

        $userExists = User::model()->find('username = :login', array(':login' => strtolower($form->email),));
        if (!$userExists) {
            Yii::app()->user->logout(false);
            $user->createAccount($data);

            Email_helper::send(strtolower($form->email), 'Регистрация на ' . Yii::app()->name . '', 'needActivation', array('data' => $user));

            // автоматический вход

            $identity = new UserIdentity(strtolower($form->email), $password);

            $identity->authenticate();
            Yii::app()->user->login($identity);

            return true;
        }


        return false;
    }

    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder = './data/items/'; // папка в которую загружаем доп файлы

        $allowedExtensions = array("jpg", "jpeg", "gif", "png");

        $sizeLimit = 2 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

        $result = $uploader->handleUpload($folder);


        $fileSize = filesize($folder . $result['filename']);

        $fileName = $result['filename'];

        // добавление файла
        //$attachment_add = new ItemsAttachments();
        //$attachment_add->name = $fileName;
        //$attachment_add->size = $fileSize;
        //$attachment_add->save();


        // для добавления чекбоксов
        $result['filename'] = $fileName;

        $result['attachment_id'] = $attachment_add->id;

        $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        echo $result;
    }

    public function actionIndex()
    {
        $this->layout = '//layouts/index';

        Yii::app()->getModule('tenders');

        $criteria = new CDbCriteria;

        $criteria->limit = 5;

        $criteria->order = 'date desc';

        $paidplace = User::model()->pro()->findAll();

        $model = new Tenders;

        $rmodel = new FastRegistrationForm;

        if (isset($_POST['ajax'])) {
            $rmodel->setScenario('ajax');
            echo CActiveForm::validate($rmodel);
            Yii::app()->end();
        }

//        $rmodel->setScenario();

        if (Yii::app()->request->isPostRequest && !empty($_POST['Tenders'])) {

            $model->setAttributes($_POST['Tenders']);

            $validate = $model->validate();

            if (!Yii::app()->user->isAuthenticated()) {
                $rmodel->setAttributes($_POST['FastRegistrationForm']);

                $validate = $rmodel->validate() && $validate;
            }


            if ($validate) {
//                Yii::app()->session['user_id'] = $user['id'];
//                Yii::app()->session['user'] = $user;
                Yii::app()->session['post'] = serialize($_POST);


//                if ($model->save()) {
                $this->redirect(array('main/more', array()));
//                }

            }
        }

        $renderdata = array(
            'model'      => $model,
            'rmodel'     => $rmodel,
            'categories' => Categories::model()->findAll(),
            'projects'   => Tenders::model()->opened()->recently()->findAll($criteria),
        );

        $this->pageTitle = 'Сеть удаленных специалистов. Поиск удаленной работы.';

        $this->render('index', $renderdata);
    }

    public function actionMore()
    {
        Yii::app()->getModule('tenders');

        $model  = new Tenders();
        $rmodel = new FastRegistrationForm();

        $post = unserialize(Yii::app()->session['post']);
//        var_dump($post);
//        exit;
        $model->setAttributes($post['Tenders']);
        $rmodel->setAttributes($post['FastRegistrationForm']);
        if (isset($_POST['ajax'])) {
            $rmodel->setScenario('ajax');
            echo CActiveForm::validate($rmodel);
            Yii::app()->end();
        }

        $rmodel->setScenario('insert');

        if (Yii::app()->request->isPostRequest && !empty($_POST['Tenders'])) {
            $model->setAttributes($_POST['Tenders']);

            $validate = $model->validate();

            if (!Yii::app()->user->isAuthenticated()) {
                $rmodel->setAttributes($_POST['FastRegistrationForm']);
                $validate = $rmodel->validate() && $validate;
            }

            if ($validate) {
                if (!Yii::app()->user->isAuthenticated()) {
                    $user = Yii::app()->db->createCommand()
                                          ->select('*')
                                          ->from('{{users}}')
                                          ->where('username = :username', array(':username' => $rmodel->email))
                                          ->queryRow();
                    if ($user !== false) {
                        $rmodel->id = $user['id'];
                        $this->createUser($rmodel);
                        $model->hash = md5(uniqid() . time());
						$tender = $model->getLastTenderByUserId($user['id']);
                        $model->tender_id = $tender->id;
                        Email_helper::send($rmodel->email, 'Новый проект на ' . Yii::app()->name . '', 'needConfirmation', array('data' => $model));
                    } else {

                        $this->createUser($rmodel);
                    }
                    $model->status = Tenders::STATUS_MODERATION;

                    $model->user_id = $rmodel->id;
                } else {
                    $model->status = Tenders::STATUS_OPEN;
                }
                if ($model->save()) {
                    $this->redirect(array('main/thanks', array()));
                }
            }
        }
        $specialities = TendersSpeciality::model()->findAll();
        $specialities = CHtml::listData($specialities, 'id', 'name');
        $this->render('more', array(
            'model'  => $model,
            'rmodel' => $rmodel,
            'specialities'=>$specialities,
        ));
    }

    public function actionThanks()
    {
        $this->render('thanks');
    }

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
//                'testLimit' => '1',
            ),
        );
    }
}