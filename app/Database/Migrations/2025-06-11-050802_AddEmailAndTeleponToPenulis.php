<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailAndTeleponToPenulis extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('penulis', [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'address',
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'email',
            ],
        ]);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('penulis', ['email', 'telepon']);
    }
}
