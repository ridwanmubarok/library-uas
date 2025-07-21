<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReturnRequestedToLoans extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('loans', [
            'return_requested' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'null' => false,
            ],
            'return_requested_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('loans', ['return_requested', 'return_requested_at']);
    }
}