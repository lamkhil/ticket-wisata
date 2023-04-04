<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;


    protected $allowedFields = [
        "user_id",
        "wisata_id",
        "transaksi_id",
        "kode",
        "claimed_at"
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
