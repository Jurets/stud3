<?php
class User extends Model
{
    const ONLINE  = 1;
    const OFFLINE = 2;

    const ROLE_USER  = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'moder';

    const TYPE_CUSTOMER  = 'customer';
    const TYPE_PERFORMER = 'performer';

    //new
    const USERTYPE_CUSTOMER  = 1;
    const USERTYPE_PERFORMER = 2;
    
    const GENDER_MALE   = 1;
    const GENDER_FEMALE = 2;
    const GENDER_THING  = 0;

    const STATUS_ACTIVE     = 1;
    const STATUS_NOT_ACTIVE = 2;

    const IS_BANNED = 1;

    const EMAIL_CONFIRM_YES = 1;
    const EMAIL_CONFIRM_NO  = 0;

    const AUTH_ATTEMPTS = 5; // максимальное количество допускаемых ошибок авторизаций

    const AUTH_REMAINED = 3600; // на сколько после допустимного ошибок авторизаций блокируется ip, в секундах

    const SPECIALIZATION_DEVELOPER  = 1;
    const SPECIALIZATION_DESIGNER   = 2;
    const SPECIALIZATION_COPYWRITER = 3;
    const SPECIALIZATION_SYSTEM     = 4;
    const SPECIALIZATION_MANAGER    = 5;
    const SPECIALIZATION_INVESTOR   = 6;

    public $invitecode; // код приглашения

    public $_tariff;

    public $_online;

    public $_userpic; // атрибут для хранения загружаемого юзерпика

    public $_logo; // атрибут для хранения загружаемого логотипа

    //function __construct()
    //{
    //Tariffs_helper::returnTariff();
    //}

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{users}}';
    }

    function getbyPk($id)
    {
        return Yii::app()->db->createCommand()
                             ->select('*')
                             ->from('{{users}}')
                             ->where('id = :id', array(':id' => $id))
                             ->queryRow();
    }

    /**
     * Обновляем последнюю активность
     */
    public function setLastActivity()
    {
        $this->last_activity = time();

        $this->online = self::ONLINE;
    }

    /**
     * Удаляем не активных в течении 10 минут пользователей - сделать, чтобы функция вызывалась каждые 5 минут, а не всегда
     */
    public function UpdateLastActivity()
    {
        return Yii::app()->db->createCommand()
                             ->update('{{users}}', array('online' => self::OFFLINE), 'last_activity < :time', array(':time' => time() - 600));
    }

    /**
     * Неправильные попытки авторизации
     */
    public function getAuthErr()
    {
        return Yii::app()->db->createCommand()
                             ->select('*')
                             ->from('{{auth_err}}')
                             ->where('ip_address = :ip_address', array(':ip_address' => Yii::app()->request->userHostAddress))
                             ->queryRow();
    }

    /**
     * Удаляем ошибки, у которых истек срок
     */
    function deleteAuthErr()
    {
        Yii::app()->db->createCommand()
                      ->delete('{{auth_err}}', 'date < :date', array(':date' => time()));
    }

    /**
     * Обновить количество неудавшихся авторизаций
     */
    public function updateAuthErr()
    {
        $query = self::getAuthErr();

        if ($query) {
            $count = $query['count'] + 1;

            Yii::app()->db->createCommand()
                          ->update('{{auth_err}}', array('count' => $count), 'ip_address = :ip_address', array(':ip_address' => Yii::app()->request->userHostAddress));
        } else {
            $data = array(
                'ip_address' => Yii::app()->request->userHostAddress,
                'date'       => time() + self::AUTH_REMAINED, // дата окончания блокировки
                'count'      => 1
            );

            Yii::app()->db->createCommand()
                          ->insert('{{auth_err}}', $data);
        }

        return false;
    }

    /**
     * Проверка пароля
     */
    public function validatePassword($password)
    {
        if ($this->password === $this->hashPassword($password)) {
            return true;
        }

        return false;
    }

    /**
     * Список уровней доступа
     */
    public function getEventSpecializationList()
    {
        return array(
            self::SPECIALIZATION_DEVELOPER  => 'Разработчик',
            self::SPECIALIZATION_DESIGNER   => 'Дизайнер',
            self::SPECIALIZATION_COPYWRITER => 'Копирайтер',
            self::SPECIALIZATION_SYSTEM     => 'Системный администратор',
        );
    }

    /**
     * Получение уровня доступа
     */
    public function getSpecialization()
    {
        $data = $this->getSpecializationList();

        return array_key_exists($this->specialization, $data) ? $data[$this->specialization] : false;
    }

    /**
     * Список уровней доступа
     */
    public function getSpecializationList()
    {
        return array(
            self::SPECIALIZATION_DEVELOPER  => 'Разработчик',
            self::SPECIALIZATION_DESIGNER   => 'Дизайнер',
            self::SPECIALIZATION_COPYWRITER => 'Копирайтер',
            self::SPECIALIZATION_SYSTEM     => 'Системный администратор',
            self::SPECIALIZATION_MANAGER    => 'Менеджер',
            self::SPECIALIZATION_INVESTOR   => 'Инвестор',
        );
    }

    /**
     * Получение уровня доступа
     */
    public function getRole()
    {
        $data = $this->getAccessLevelsList();

        return array_key_exists($this->access_level, $data) ? $data[$this->access_level] : 'не найден';
    }

    /**
     * Список уровней доступа
     */
    public function getRoleList()
    {
        return array(
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_MODER => 'Модератор',
            self::ROLE_USER  => 'Пользователь'
        );
    }

    /**
     * Список статусов пользователя
     */
    public function getStatusList()
    {
        return array(
            self::STATUS_ACTIVE     => 'Активен',
            self::STATUS_NOT_ACTIVE => 'Не активирован'
        );
    }

    /**
     * Получить статус
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return array_key_exists($this->status, $data) ? $data[$this->status] : 'не найден';
    }

    /**
     * Список статусов пользователя
     */
    public function getTariffList()
    {
        return array(
            Tariffs::PRO => '<a href="/account/tariff" class="ac-pro"><img src="/images/f-pro.png" alt="PRO"  /></a>',
        );
    }

    /**
     * Получить статус
     */
    public function getTariff()
    {
        $data = $this->getTariffList();

        return array_key_exists($this->tariff, $data) ? $data[$this->tariff] : false;
    }

    /**
     * Список статусов пользователя
     */
    public function getOnlineList()
    {
        return array(
            self::ONLINE  => '<img src="/images/dot_active.png" class="u-inact" alt="На сайте" title="На сайте" />',
            self::OFFLINE => '<img src="/images/dot_inactive.png" class="u-inact" alt="Нет на сайте" title="Нет на сайте" />',
        );
    }

    /**
     * Получить статус
     */
    public function getOnline()
    {
        $data = $this->getOnlineList();

        return array_key_exists($this->online, $data) ? $data[$this->online] : false;
    }

    /**
     * Список статусов пользователя
     */
    public function getIconList()
    {
        return array(
            self::ROLE_USER  => '',
            self::ROLE_ADMIN => '<img src="/images/team.gif" alt="Команда сайта" title="Команда сайта /> ',
            self::ROLE_MODER => '<img src="/images/team.gif" alt="Команда сайта" title="Команда сайта" /> ',
        );
    }

    /**
     * Получить статус
     */
    public function getIco()
    {
        $data = $this->getIconList();

        return array_key_exists($this->role, $data) ? $data[$this->role] : false;
    }

    /**
     * Список полов
     */
    public function getGendersList()
    {
        return array(
            self::GENDER_FEMALE => 'женский',
            self::GENDER_MALE   => 'мужской',
            self::GENDER_THING  => 'неизвестно'
        );
    }

    /**
     * Получить пол
     */
    public function getGender()
    {
        $data = $this->getGendersList();

        return array_key_exists($this->gender, $data) ? $data[$this->gender] : 'не найден';
    }

    public function getCategories()
    {
        $query = Yii::app()->db->createCommand()
                               ->select('*')
                               ->from('{{categories}}')
                               ->queryAll();

        foreach ($query as $row) {
            $result[$row['parent_id']][$row['id']] = $row['name'];
        }

        return $result;

    }

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function afterSave()
    {
        if ($this->isNewRecord) // если новая запись
        {
            // таблица для хранение параметров поиска пользователей
            $search = new UsersSearch;
            $search->user_id = $this->id;
            $search->save();
            // таблица для статичных данных
            $static = new UsersStatic;
            $static->user_id = $this->id;
            $static->save();
            // таблица для данных о тарифе
            $tariff = new UsersTariff;
            $tariff->user_id = $this->id;
            $tariff->save();
            // таблица для данных о рейтинге пользователя
            $rating = new UsersRating;
            $rating->user_id = $this->id;
            $rating->save();
            Yii::app()->getModule('tenders');
            // таблица для данных о рейтинге пользователя
            $tender = new TendersSearch;
            $tender->user_id = $this->id;
            $tender->save();
            // оповещения
            $notify = new UsersNotify;
            $notify->user_id = $this->id;
            $notify->save();
            if ($this->scenario == 'onRegistrationInvite') {
                if ($this->invitecode) {
                    Invites::model()->update($this->invitecode, $this->id);
                }
            }
        }
        return parent::afterSave();
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) // если новая запись
        {
            $this->role = self::ROLE_USER; // роль по умолчанию

            $this->created = time();

            //$this->activation_code = $this->generateActivationKey();// код активации
            $this->activation_code = Randomness::randomString(10);

            $this->registration_ip = Yii::app()->request->userHostAddress; // ip при регистрации
        } else // если изменение
        {
            $this->ip_address = Yii::app()->request->userHostAddress; // ip

            $this->last_activity = time(); // дата измененния
        }

        return parent::beforeSave();
    }

    public function relations()
    {
        return array(
            'static' => array(self::HAS_ONE, 'UsersStatic', 'user_id'), // статистическая информация о пользователе - количество друзей и т п
        );
    }

    public function scopes()
    {
        return array(
            'pro'          => array(
                'condition' => 'tariff = :tariff',
                'params'    => array(':tariff' => Tariffs::PRO)
            ),
            'active'       => array(
                'condition' => 'status = :status',
                'params'    => array(':status' => self::STATUS_ACTIVE)
            ),
            'notActivated' => array(
                'condition' => 'status = :status',
                'params'    => array(':status' => self::STATUS_NOT_ACTIVE)
            ),
            'banned'       => array(
                'condition' => 'is_banned = :is_banned',
                'params'    => array(':is_banned' => self::IS_BANNED)
            ),
            'admin'        => array(
                'condition' => 'access_level = :access_level',
                'params'    => array(':access_level' => self::ROLE_ADMIN)
            ),
            'user'         => array(
                'condition' => 'access_level = :access_level',
                'params'    => array(':access_level' => self::ROLE_USER)
            ),
            'min'          => array(
                'select' => 'username, name, surname, userpic, last_activity, tariff, online',
            ),
        );
    }

    /*
        public function defaultScope()
        {
            return array(
                'select' => 'id',
            );
        }
    */
    /**
     * Хэш пароля
     */
    public function hashPassword($password)
    {
        $password = md5($password . 'cms');

        return $password;
    }

    /**
     * Генерация пароля
     */
    public function generateRandomPassword($length = null)
    {
        if (!$length) {
            $length = Yii::app()->getModule('user')->minPasswordLength;
        }

        return substr(md5(uniqid(mt_rand(), true) . time()), 0, $length);
    }

    /**
     * Генерация кода активации
     */
    public function generateActivationKey()
    {
        return md5(time() . $this->email . uniqid());
    }

    public function rules()
    {
        return array(
//            array('username', 'form_validation', 'rule' => 'alpha_numeric'),
            array('username, name, surname, gender', 'required', 'on' => 'profile'), // редактирование профиля
            array('username', 'unique'),
            //array('short_descr, full_descr', 'form_validation', 'rule' => 'nospecial'),
            array('userpic', 'file',
                'types'      => 'jpg, gif, png',
                'maxSize'    => 1024 * 1024 * 5, // 5 MB
                'allowEmpty' => true,
                'tooLarge'   => 'Файл весит больше 5 MB. Пожалуйста, загрузите файл меньшего размера.',
                'on'         => 'userpic'
            ),
            array('logo', 'file',
                'types'      => 'jpg, gif, png',
                'maxSize'    => 1024 * 1024 * 5, // 5 MB
                'allowEmpty' => true,
                'tooLarge'   => 'Файл весит больше 5 MB. Пожалуйста, загрузите файл меньшего размера.',
                'on'         => 'logo'
            ),
            array('email', 'required', 'on' => 'contact'), // редактирование контактных данных
            array('icq, skype, telephone', 'length', 'max' => 16),
            array('full_descr', 'length', 'max' => 10000),
            //array('email, username', 'email'),   //не проверяем, чтобы логин был как емейл
            array('email', 'email'),
//            array('username', 'unique'),
//            array('email', 'unique'),
            array('website', 'url'),
            array('username, specialization, old_password, password, password2, email, name, surname, userpic, userpic_f, gender, country, city, dob, short_descr, full_descr, full_descr_v, status, email_confirm, role, age, logo, tariff', 'safe')
        );
    }

    public function behaviors()
    {
        return array(
            'tags' => array(
                'class'                => 'EARTaggableBehavior',
                'tagTable'             => '{{interests}}',
                'tagModel'             => 'Interests',
                'tagBindingTable'      => '{{users_interests}}',
                'modelTableFk'         => 'user_id',
                'tagTablePk'           => 'id',
                'tagTableName'         => 'name',
                'tagBindingTableTagId' => 'interest',
            )
        );
    }

    public function beforeValidate() {
        //$this->username = $this->email;  //не заносим емейл в логин
        return parent::beforeValidate();
    }

    /**
     * Метки
     */
    public function attributeLabels()
    {
        return array(
            'username'       => 'Логин',
            'surname'        => 'Фамилия',
            'name'           => 'Имя',
            'gender'         => 'Пол',
            'password'       => 'Пароль',
            'password2'      => 'Повтор пароля',
            'dob'            => 'Дата рождения',
            'short_descr'    => 'Краткое описание',
            'full_descr'     => 'Полное описание',

            'icq'            => 'ICQ',
            'skype'          => 'Skype',
            'telephone'      => 'Телефон',
            'website'        => 'Web-сайт',
            'agree'          => 'Принимаю условия <a href="/pages/agreement.html" target="_blank">пользовательского соглашения</a>',

            'age'            => 'Возраст',


            'created'        => 'Дата регистрации',
            'status'         => 'Статус',

            'country'        => 'Страна',
            'city'           => 'Город',

            'specialization' => 'Деятельность',
        );
    }

    /**
     * Регистрация пользователя
     * @param $data массив с данными
     */
    public function createAccount($data, $status = self::STATUS_NOT_ACTIVE)
    {
        extract($data); // Импортировать переменные из массива в текущую символьную таблицу.
        $password = $this->hashPassword($password);
        $module = Yii::app()->getModule('user');
        $this->setAttributes(array(
            'username'      => $username,
            'name'          => $name,
            'surname'       => $surname,
            'email'         => $email,
            'password'      => $password,

            'gender'        => $gender,
            'country'       => $country,
            'city'          => $city,
            'telephone'     => $telephone,
            
            'tariff'        => Tariffs::START,
            'userpic_f'     => $module->standartUserpic_f,
            'userpic'       => $module->standartUserpic,
            'status'        => $status,
            'email_confirm' => self::EMAIL_CONFIRM_NO
        ));
        return $this->save(false);
    }

    /**
     * Регистрация пользователя-исполнителя
     * @param $data массив с данными
     */
    public function createPerformer($data, $status = self::STATUS_NOT_ACTIVE)
    {
        //$password = $this->hashPassword($password);
        $module = Yii::app()->getModule('user');
        $this->setAttributes(CMap::mergeArray($data, array(
            'password'      => $this->hashPassword($data['password']),
            'tariff'        => Tariffs::START,
            'userpic_f'     => $module->standartUserpic_f,
            'userpic'       => $module->standartUserpic,
            'status'        => $status,
            'email_confirm' => self::EMAIL_CONFIRM_NO
        )), false);
        $this->usertype = 2;
        return $this->save(false);
    }
    
    /**
     * Изменение пароля
     */
    public function changePassword($password)
    {
        $this->password = $this->hashPassword($password);

        return $this->update(array('password'));
    }

    /**
     * Активация
     */
    public function activate()
    {
        $this->activation_ip = Yii::app()->request->userHostAddress;
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm = self::EMAIL_CONFIRM_YES;
        //$this->save();
        return $this->save();
    }

    public function country()
    {
        return Country::model()->getNameById($this->country);
    }

    public function city()
    {
        return City::model()->getNameById($this->city);
    }

    public function is_banned()
    {
        if ($this->is_banned == self::IS_BANNED) {
            return true;
        }

        return false;
    }

    public function banned()
    {
        return UsersBanned::model()->text($this->id);
    }

    public function cat($search)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'tariff DESC'; // пользователи с pro тарифом сверху
        if ($search->status != UsersSearch::STATUS_ON) {
            return $this;
        }
        if ($search->keywords) {
            $criteria->addCondition('username = :keywords', 'AND');
            $criteria->params += array(':keywords' => $search->keywords);
        }
        if ($search->username) {
            $criteria->addCondition('username = :username', 'AND');
            $criteria->params += array(':username' => $search->keywords);
        }
        if ($search->favorite) // у меня в подписчиках
        {
            $criteria->addCondition('`id` IN (SELECT favorite FROM {{users_favorites}} WHERE {{users_favorites}}.`user_id` = :user_id)', 'AND');
            $criteria->params[':user_id'] = Yii::app()->user->id;
        }
        if ($search->portfolio) {
            $criteria->addCondition("portfolio > 0", 'AND');
        }
        if ($search->reviews) {
            $criteria->addCondition("reviews_positive > 0", 'AND');
        }
        if ($search->interests) {
            $this->withTags($search->interests);
        }
        $this->getDbCriteria()->mergeWith($criteria);

        return $this;
    }

    public function age()
    {
        if (!$this->dob) {
            return false;
        }

        if ($data = explode('.', $this->dob)) {
            return Date_helper::date_age($data[0], $data[1], $data[2]);
        }

        return false;
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->_tariff = self::getTariff();

        $this->_online = self::getOnline();
    }
    
    public function getNickName() {
        $nick = trim($this->name . ' ' . $this->surname);
        $nick = !empty($nick) ? $nick : $this->username;
        return $nick;
    }
}