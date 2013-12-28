<?php

class m131227_214536_new_speciality extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp() {
        $this->createTable('{{speciality}}', array(
            'id' => 'INT(10) NOT NULL AUTO_INCREMENT', 
            'name'=>'VARCHAR(255) DEFAULT NULL',
            'PRIMARY KEY (id)',
        ),
        'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci'
        );
        $this->insert('{{speciality}}', array('name'=>'Специализация 1'));
        $this->insert('{{speciality}}', array('name'=>'Специализация 2'));
        $this->insert('{{speciality}}', array('name'=>'Специализация 3'));
        
        $this->addColumn('{{tenders}}', 'speciality', 'INT(11) DEFAULT NULL');
	}

	public function safeDown() {
        $this->dropTable('ci_speciality');
        $this->addColumn('{{tenders}}', 'speciality');
	}
	
}