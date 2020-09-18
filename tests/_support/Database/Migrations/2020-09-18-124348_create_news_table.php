<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'varchar', 'constraint' => 55, 'null' => true],
            'description' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('news', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('news', true);
	}
}
