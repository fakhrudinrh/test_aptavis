<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClubsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'club_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'club_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'club_city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('club_id', true);
        $this->forge->createTable('clubs');
    }

    public function down()
    {
        $this->forge->dropTable('clubs');
    }
}
