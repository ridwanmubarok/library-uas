<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'cover' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('books');
    }

    public function down(): void
    {
        $this->forge->dropTable('books');
    }
} 