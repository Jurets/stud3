<?php
class SbsWorkFile extends CActiveRecord
{
    const MAX = 10;
    
    /**
     * Returns the static model of the specified AR class.
     * @return Comment the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{sbswork_files}}';
    }

	public function relations()
    {
        return array(
            'sbswork' => array(self::BELONGS_TO, 'SbsWork', 'sbswork_id'),
        );
    }

	public function rules()
	{
		return array(
			array('sbswork_id, filename, origname, size', 'required'),
		);
	}

}