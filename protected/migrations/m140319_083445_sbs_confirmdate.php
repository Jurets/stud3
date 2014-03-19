<?php

class m140319_083445_sbs_confirmdate extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{sbs}}', 'confirmdate', 'INT(11)');
	}

	public function down()
	{
		$this->dropColumn('{{sbs}}', 'confirmdate');
	}

}