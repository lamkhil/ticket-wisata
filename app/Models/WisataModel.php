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

    
    protected $afterFind = ['tiket'];

    public function tiket(array $data)
    {   
        try {
            if ($data['data']==null) {
                return $data;
            }
            if ($data['singleton']) {
                $data['data']['tiket'] = (new TiketModel())->where('wisata_id', $data['id'])->findAll();
                return $data;
            }else{
                $temp = [];
                foreach ($data['data'] as $item) {
                    $item['tiket']= (new TiketModel())->where('wisata_id', $item['id'])->findAll();
                    array_push($temp, $item);
                }
                $data['data'] = $temp;
                return $data;
            }
        } catch (\Throwable $th) {
            return $data;
        }
    }

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
