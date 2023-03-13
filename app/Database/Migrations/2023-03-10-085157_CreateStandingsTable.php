<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStandingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'standing_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'club_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'       => true,
            ],
            'played' => [
                'type' => 'INT',
                'constraint' => 2,
                'default'    => 0,
            ],
            'won' => [
                'type' => 'INT',
                'constraint' => 2,
                'default'    => 0,
            ],
            'draw' => [
                'type' => 'INT',
                'constraint' => 2,
                'default'    => 0,
            ],
            'lost' => [
                'type' => 'INT',
                'constraint' => 2,
                'default'    => 0,
            ],
            'goals_for' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'    => 0,
            ],
            'goals_againts' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'    => 0,
            ],
            'points' => [
                'type' => 'INT',
                'constraint' => 3,
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('standing_id', true);
        $this->forge->addForeignKey('club_id', 'clubs', 'club_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('standings');
    }

    public function down()
    {
        $this->forge->dropTable('standings');
    }
}
