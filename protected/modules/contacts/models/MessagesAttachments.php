<?php
class MessagesAttachments extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
	public function tableName()
	{
		return '{{messages_files}}';
	}

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}