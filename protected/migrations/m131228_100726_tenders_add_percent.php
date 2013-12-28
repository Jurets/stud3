<?php

class m131228_100726_tenders_add_percent extends CDbMigration
{
	public function up(){
        $this->addColumn('{{tenders}}', 'percent', 'INT(11) DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('{{tenders}}', 'percent');
	}

}