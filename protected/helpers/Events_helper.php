<?php
class Events_helper
{
	private $id;

	// приглашения
	const SENT_INVITE = 'отправил вам приглашение';
	const ACCEPTED_INVITE = 'принял ваше приглашение';
	const REJECTED_INVITE = 'отлонил ваше приглашение';

	// блоги
	const COMMENTED_BLOGS = 'добавил комментарий к вашей записи в блоге';

	// личные сообщения
	const SENT_MESSAGES = 'отправил вам личное сообщение';

	// удаленная работа
	const BID_PROJECTS = 'добавил заявку к вашему проекту';
	const DECLINED_PROJECTS = 'отклонил вашу заявку';
	const ACCEPTED_PROJECTS = 'принял вашу заявку';
	const LETTER_PROJECTS = 'отправил вам сообщение в проекте';
	const NOTIFY_PROJECTS = 'приглашает вас принять участие в опубликованном проекте';

	// каталог товаров
	const PAYMENT_ITEMS = 'отправил платеж за товар размещенный каталоге';
	const BUY_ITEMS = 'купил ваш размещенный товар в каталоге';
	const COMPLETED_ITEMS = 'завершил платеж за товар размещенный в каталоге';

	// сообщества
	const INVINTATION = 'приглашает вступить в сообщество';

    //новые (Jurets)
    const NOTIFY_NEWSBSOFFER = 'предлагает вам сделку по проекту';
    const NOTIFY_NEWSBSCONFIRM = 'согласился на выполнение проекта';
    const NOTIFY_NEWSBSREJECT = 'отказался от выполнения проекта';
    const NOTIFY_SBSRESERVED = 'оплатил заказ';
    const NOTIFY_SBSDONE = 'сдал работу';
    const NOTIFY_SBSDISPUTE = 'подал жалобу в арбитраж';
    const NOTIFY_SBSCOMPLETE = 'сделка завершена';
    const NOTIFY_SBSDELAY = 'сделка просрочена';
    
	function __construct($user_id, $object, $title, $id = '')
	{
		$this->create($user_id, $object, $title, $id);
	}

    public function getLocationList()
    {
		return array(
			self::SENT_INVITE => 'account/invitations',
			self::ACCEPTED_INVITE => FALSE,
			self::REJECTED_INVITE => FALSE,

			self::COMMENTED_BLOGS => 'blogs/'.$this->id.'.html#comments',

			self::SENT_MESSAGES => 'contacts/?message=new',

			self::BID_PROJECTS => 'tenders/'.$this->id.'.html',
			self::DECLINED_PROJECTS => 'tenders/'.$this->id.'.html',
			self::ACCEPTED_PROJECTS => 'tenders/'.$this->id.'.html',
			self::LETTER_PROJECTS => 'tenders/'.$this->id.'.html',
			self::NOTIFY_PROJECTS => 'tenders/'.$this->id.'.html',

			self::PAYMENT_ITEMS =>  'payments/'.$this->id.'.html',
			self::BUY_ITEMS => FALSE,
			self::COMPLETED_ITEMS => FALSE,

            self::INVINTATION => '/commune/default/management?id='.$this->id.'&action=enter',
			
            //новые (Jurets)
            self::NOTIFY_NEWSBSOFFER => '/sbs/show?id='.$this->id,
            self::NOTIFY_NEWSBSCONFIRM => '/sbs/reserve?id='.$this->id,
            self::NOTIFY_NEWSBSREJECT => '/sbs/publication?id='.$this->id,
            self::NOTIFY_SBSRESERVED => '/sbs/'.$this->id,
            self::NOTIFY_SBSDONE => '/sbs/'.$this->id,
            self::NOTIFY_SBSDISPUTE => '/sbs/'.$this->id,
            self::NOTIFY_SBSCOMPLETE => '/sbs/'.$this->id,
            self::NOTIFY_SBSDELAY => '/sbs/'.$this->id,
        );
    }

    public function getLocation($const)
    {
		$data = self::getLocationList();
		return array_key_exists($const, $data) ? $data[$const] : FALSE;
    }

    public function getLinkList()
    {
		return array(
			self::SENT_INVITE => 'Принять приглашение',
	
			self::COMMENTED_BLOGS => 'Перейти к записи',

			self::SENT_MESSAGES => 'Перейти к сообщениям',
	
			self::BID_PROJECTS => 'Перейти к проекту',
			self::DECLINED_PROJECTS => 'Перейти к проекту',
			self::ACCEPTED_PROJECTS => 'Перейти к проекту',
			self::LETTER_PROJECTS => 'Перейти к проекту',
			self::NOTIFY_PROJECTS => 'Перейти к проекту',

			self::PAYMENT_ITEMS => 'Перейти к платежу',

			self::INVINTATION => 'Вступить в сообщество',

            //новые (Jurets)
            self::NOTIFY_NEWSBSOFFER => 'Перейти к сделке',
            self::NOTIFY_NEWSBSCONFIRM => 'Перейти к резервированию',
            self::NOTIFY_NEWSBSREJECT => 'Выбрать нового исполнителя',
            self::NOTIFY_SBSRESERVED => 'Приступить к выполнению задачи',
            self::NOTIFY_SBSDONE => 'Перейти к сделке',
            self::NOTIFY_SBSDISPUTE => 'Перейти к сделке',
            self::NOTIFY_SBSCOMPLETE => 'Перейти к сделке',
            self::NOTIFY_SBSDELAY => 'Перейти к сделке',
        );
    }

    public function getLink($const)
    {
		$data = self::getLinkList();
		return array_key_exists($const, $data) ? $data[$const] : FALSE;
    }

    public function getTypeList()
    {
		return array(
			self::SENT_INVITE => Events::TYPE_INVITE,
			self::ACCEPTED_INVITE => Events::TYPE_INVITE,
			self::REJECTED_INVITE => Events::TYPE_INVITE,

			self::COMMENTED_BLOGS => Events::TYPE_BLOGS,

			self::SENT_MESSAGES => Events::TYPE_MESSAGES,

			self::BID_PROJECTS => Events::TYPE_PROJECTS,
			self::DECLINED_PROJECTS => Events::TYPE_PROJECTS,
			self::ACCEPTED_PROJECTS => Events::TYPE_PROJECTS,
			self::LETTER_PROJECTS => Events::TYPE_PROJECTS,

			self::PAYMENT_ITEMS => Events::TYPE_ITEMS,
			self::BUY_ITEMS => Events::TYPE_ITEMS,
			self::COMPLETED_ITEMS => Events::TYPE_ITEMS,

			self::INVINTATION => Events::TYPE_COMMUNE,

            //новые (Jurets)
            self::NOTIFY_NEWSBSOFFER => Events::TYPE_SBS,
            self::NOTIFY_NEWSBSCONFIRM => Events::TYPE_SBS,
            self::NOTIFY_NEWSBSREJECT => Events::TYPE_SBS,
            self::NOTIFY_SBSRESERVED => Events::TYPE_SBS,
            self::NOTIFY_SBSDONE => Events::TYPE_SBS,
            self::NOTIFY_SBSDISPUTE => Events::TYPE_SBS,
            self::NOTIFY_SBSCOMPLETE => Events::TYPE_SBS,
            self::NOTIFY_SBSDELAY => Events::TYPE_SBS,
        );
    }


    public function getType($const)
    {
		$data = self::getTypeList();
		return array_key_exists($const, $data) ? $data[$const] : FALSE;
    }

	// создать событие
    public function create($user_id, $object, $title, $id = '')
	{
		if( $id ) {
			$this->id = $id;
		}
		$user = User::getbyPk($object);
		$event = new Events;
		$event->user_id = $user_id;
		$event->object = $object;
		$event->title = 'Пользователь '.$user['name'].' '.$user['surname'].' '.$title;
		$event->status = Events::STATUS_OPEN;
		$event->type = self::getType($title);
		$event->location = self::getLocation($title);
		$event->link = self::getLink($title);

		$event->save();
		$user = User::getbyPk($user_id);
		$notify = UsersNotify::model()->user($user_id)->find();
		if( $event->type == Events::TYPE_INVITE ) {
			$notify = $notify->invite;
		} elseif( $event->type == Events::TYPE_BLOGS ) {
			$notify = $notify->blogs;
		} elseif( $event->type == Events::TYPE_PROJECTS ) {
			$notify = $notify->projects;
		} elseif( $event->type == Events::TYPE_ITEMS ) {
			$notify = $notify->items;
		} elseif( $event->type == Events::TYPE_MESSAGES ) {
			$notify = $notify->messages; 
		} else {
			$notify = FALSE;
		}
		if( $notify ) {
			//отправка события на email, если у пользователя в опциях разрешена отправка
			Email_helper::send($user['email'], 'Уведомления о событие', 'NewEvent', array('user' => $user, 'title' => $event->title));
		}
	}
}