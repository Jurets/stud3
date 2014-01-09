<?php
class File_helper {

	public static function getTempDir()
	{
        $tmpdir = Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tmp';
        //$tmpdir = 'www/free-stud.ru/tmp';
        return $tmpdir;
	}

}