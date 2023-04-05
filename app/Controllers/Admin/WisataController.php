<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class WisataController extends BaseController
{
    public function index()
    {
        return $this->render('pages.admin.wisata.create');
    }

    public function create()
    {
        return redirect('wisata')->with('success', 'Berhasil menambahkan tempat wisata');
    }
}
