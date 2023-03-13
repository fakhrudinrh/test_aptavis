<?php

namespace App\Models;

use CodeIgniter\Model;

class ClubsModel extends Model
{
    protected $table            = 'clubs';
    protected $primaryKey       = 'club_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['club_name', 'club_city'];
}
