<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\WisataModel;
use Fluent\Auth\Facades\Auth;

class Home extends BaseController
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return redirect('login');
        }
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'user') {
            return $this->render('pages.user.dashboard', ['wisata'=>(new WisataModel())->findAll()]);
        }else{
            return $this->render('pages.admin.dashboard');
        }
    }

    public function admin(){
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return $this->render('auth.admin');
        }
    }

    public function transaksi(){
        return $this->render('pages.admin.transaksi',['transaksi'=>(new TransaksiModel())->findAll()]);
    }

    public function scan(){
        return $this->render('pages.admin.scan');
    }
    public function wisata(){
        return $this->render('pages.admin.wisata', ['wisata'=>(new WisataModel())->findAll()]);
    }

    public function user(){
        return $this->render('pages.admin.user.index', ['admin'=>(new UserModel())->where('role','admin')->findAll()]);
    }
}
