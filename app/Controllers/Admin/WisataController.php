<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WisataModel;

class WisataController extends BaseController
{

    public function index()
    {
        return $this->render('pages.admin.wisata.create');
    }

    public function create()
    {
        try {
            $validationRule = [
                'photo' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[photo]',
                        'is_image[photo]',
                        'mime_in[photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    ],
                ],
                'nama' => 'required',
                'harga' => 'required',
                'alamat' => 'required'
            ];
            if (!$this->validate($validationRule)) {

                return redirect()->back()->with('error', $this->validator->getErrors());
            }
            $img = $this->request->getFile('photo');
            $path = '';
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $path = 'uploads/' . $newName;
                $img->move(ROOTPATH . 'public/uploads/', $newName);
            } else {
                return redirect()->back()->with('success', "invalid file");
            }
            $request = (object) $this->request->getPost();
            $data = json_decode(json_encode($request), true);
            $data['photo_path'] = base_url($path);
            (new WisataModel())->insert($data);
            return redirect('wisata')->with('success', 'Berhasil menambahkan tempat wisata');
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function edit($id)
    {
        return $this->render('pages.admin.wisata.edit', ['wisata' => (new WisataModel())->find($id)]);
    }

    public function update($id)
    {
        try {
            $validationRule = [
                'nama' => 'required',
                'harga' => 'required',
                'alamat' => 'required'
            ];
            if (!$this->validate($validationRule)) {

                return redirect()->back()->with('error', $this->validator->getErrors());
            }
            $request = (object) $this->request->getPost();
            $data = json_decode(json_encode($request), true);
            $img = $this->request->getFile('photo');
            $path = '';
            if ($img->getFilename() != '') {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $path = 'uploads/' . $newName;
                    $img->move(ROOTPATH . 'public/uploads/', $newName);

                    $data['photo_path'] = base_url($path);
                } else {
                    return redirect()->back()->with('error', "invalid file");
                }
            }
            (new WisataModel())->where('id', $id)->set($data)->update();
            return redirect('wisata')->with('success', 'Berhasil update tempat wisata');
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete($id)
    {
        try {
            (new WisataModel())->delete($id);
            return redirect('wisata')->with('success', 'Berhasil menghapus tempat wisata');
        } catch (\Throwable $th) {
            return redirect('wisata')->with('error', $th->getMessage());
        }
    }
}
