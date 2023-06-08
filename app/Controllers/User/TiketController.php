<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TiketModel;
use App\Models\TransaksiModel;
use App\Models\WisataModel;
use Fluent\Auth\Facades\Auth;
use CodeIgniter\API\ResponseTrait;

class TiketController extends BaseController
{
     use ResponseTrait;

    public function index()
    {
        $transaksi = (new TransaksiModel())->where('user_id',Auth::user()->id)->findAll();
        return $this->render('pages.user.tiket', ['transaksi' => $transaksi]);
    }

    public function show()
    {
        try {
        $request = (object) $this->request->getGet();
        $data = json_decode(json_encode($request), true);

        if ($data['slug']==null) {
            return redirect('tiket');
        }
        $transaksi = (new TransaksiModel())->where('slug',$data['slug'])->first();
        if ($transaksi == null) {
            return redirect('tiket');
        }
        return $this->render('pages.user.tiketshow', ['tiket'=>$transaksi['tiket'], 'wisata'=>$transaksi['wisata'],'pengguna'=>Auth::user()]);
        } catch (\Throwable $th) {
            return redirect('tiket');
        }
    }

    public function klaim()
    {
        try {
        $request = (object) $this->request->getGet();
        $data = json_decode(json_encode($request), true);

        if ($data['kode']==null) {
            return $this->respond([
                'status'=>false,
                'message'=>'Kode QR tidak terdaftar!'
            ]);
        }
        $model = (new TiketModel());
        $tiket = $model->where('kode',$data['kode'])->first();
        
        if ($tiket == null) {
            return $this->respond([
                'status'=>false,
                'message'=>'Kode QR tidak terdaftar!'
            ]);
        }
        if ($tiket['claimed_at']!=null) {
            return $this->respond([
                'status'=>false,
                'message'=>'Kode QR sudah digunakan!'
            ]);
        }
        $model->update($tiket['id'], [
            'claimed_at'=>date('Y-m-d H:i:s')
        ]);
        return $this->respond([
            'status'=>true,
            'message'=>'Berhasil scan QR!'
        ]);
        } catch (\Throwable $th) {
            return $this->respond([
                'status'=>false,
                'message'=>'Kode QR tidak terdaftar!'
            ]);
        }
    }

    
}
