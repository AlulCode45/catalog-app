<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Discount extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'discount_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'discount_description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'discount_percent' => [
                'type' => 'INT',
                'null' => false,
            ],
            'discount_active' => [
                'type' => 'INT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('discount');
    }

    public function down()
    {
        $this->forge->dropTable('discount');
    }
}
