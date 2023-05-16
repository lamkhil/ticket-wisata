<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TiketModel;
use App\Models\TransaksiModel;
use App\Models\WisataModel;
use Fluent\Auth\Facades\Auth;

class TiketController extends BaseController
{

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

    
}
