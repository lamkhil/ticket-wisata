<?php

namespace App\Models;

use CodeIgniter\Model;

class WisataModel extends Model
{
    protected $table = 'wisata';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;


    protected $allowedFields = [
        "nama",
        "harga",
        "photo_path",
        "alamat",
    ];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
