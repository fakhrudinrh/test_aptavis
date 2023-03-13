<?php

namespace App\Models;

use CodeIgniter\Model;

class StandingsModel extends Model
{
    protected $table            = 'standings';
    protected $primaryKey       = 'standing_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['club_id', 'played', 'won', 'draw', 'lost', 'goals_for', 'goals_againts', 'points'];
}
