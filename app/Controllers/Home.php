<?php

namespace App\Controllers;
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
            return $this->render('pages.user.dashboard');
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
}
