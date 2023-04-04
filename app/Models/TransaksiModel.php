<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;


    protected $allowedFields = [
        "slug",
        "user_id",
        "amount",
        "status",
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
