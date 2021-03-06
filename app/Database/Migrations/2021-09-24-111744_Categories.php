<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'id'          => [
                        'type'           => 'INT',
                        'constraint'     => 5,
                        'unsigned'       => true,
                        'auto_increment' => true,
                ],
                'name'       => [
                        'type'       => 'VARCHAR',
                        'constraint' => '100',
                ],
                'parent_id' => [
                        'type'           => 'INT',
                        'null'           => true,
                        'constraint'     => 5,
                        'unsigned'       => true,
                ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('parent_id','categories','id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
