<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Fluent\Auth\Facades\Hash;

class UserController extends BaseController
{

    public function index()
    {
        return $this->render('pages.admin.user.create');
    }

    public function create()
    {
        try {
            $validationRule = [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required|min_length[6]'
            ];
            if (!$this->validate($validationRule)) {

                return redirect()->back()->with('error', $this->validator->getErrors());
            }
            $request = (object) $this->request->getPost();
            $data = json_decode(json_encode($request), true);
            $data['role'] = 'admin';
            $data['password'] = Hash::make($data['password']);
            (new UserModel())->insert($data);
            return redirect('user')->with('success', 'Berhasil menambahkan admin');
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function edit($id)
    {
        return $this->render('pages.admin.user.edit', ['admin' => (new UserModel())->find($id)]);
    }

    public function update($id)
    {
        try {
            $validationRule = [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required|min_length[6]'
            ];
            if (!$this->validate($validationRule)) {

                return redirect()->back()->with('error', $this->validator->getErrors());
            }
            $request = (object) $this->request->getPost();
            $data = json_decode(json_encode($request), true);
            $data['password'] = Hash::make($data['password']);
            (new UserModel())->where('id', $id)->set($data)->update();
            return redirect('user')->with('success', 'Berhasil update admin');
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete($id)
    {
        try {
            (new UserModel())->delete($id);
            return redirect('user')->with('success', 'Berhasil menghapus admin');
        } catch (\Throwable $th) {
            return redirect('user')->with('error', $th->getMessage());
        }
    }
}
