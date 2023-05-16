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
        "wisata_id",
        "midtrans_result"
    ];

    protected $afterFind = ['tiket','wisata','user'];

    public function tiket(array $data)
    {   
        try {
            if ($data['data']==null) {
                return $data;
            }
            if ($data['singleton']) {
                $data['data']['tiket'] = (new TiketModel())->where('transaksi_id', $data['data']['id'])->findAll();
                return $data;
            }else{
                $temp = [];
                foreach ($data['data'] as $item) {
                    $item['tiket']= (new TiketModel())->where('transaksi_id', $item['id'])->findAll();
                    array_push($temp, $item);
                }
                $data['data'] = $temp;
                return $data;
            }
        } catch (\Throwable $th) {
            return $data;
        }
    }

    public function wisata(array $data)
    {   
        try {
            if ($data['data']==null) {
                return $data;
            }
            if ($data['singleton']) {
                $data['data']['wisata'] = (new WisataModel())->find($data['data']['wisata_id']);
                return $data;
            }else{
                $temp = [];
                foreach ($data['data'] as $item) {
                    $item['wisata']= (new WisataModel())->find($item['wisata_id']);
                    array_push($temp, $item);
                }
                $data['data'] = $temp;
                return $data;
            }
        } catch (\Throwable $th) {
            return $data;
        }
    }

    public function user(array $data)
    {   
        try {
            if ($data['data']==null) {
                return $data;
            }
            if ($data['singleton']) {
                $data['data']['user'] = (new UserModel())->find($data['data']['user_id']);
                return $data;
            }else{
                $temp = [];
                foreach ($data['data'] as $item) {
                    $item['user']= (new UserModel())->find($item['user_id']);
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
