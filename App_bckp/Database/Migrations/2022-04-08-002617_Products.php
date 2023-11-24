<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
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
            'userid' => [
                'type' => 'INT',
                'null' => false
            ],
            'product_name' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'product_description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'product_category' => [
                'type' => 'INT',
                'null' => false,
            ],
            'product_price' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'product_stock' => [
                'type' => 'INT',
                'null' => false,
            ],
            'product_discount' => [
                'type' => 'INT',
                'null' => true,
            ],
            'product_image' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
