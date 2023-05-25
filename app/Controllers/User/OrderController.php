<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TiketModel;
use App\Models\TransaksiModel;
use App\Models\WisataModel;
use Fluent\Auth\Facades\Auth;

class OrderController extends BaseController
{

    public function index($id)
    {
        $wisata = (new WisataModel())->find($id);
        return $this->render('pages.user.order', ['wisata' => $wisata, 'user' => Auth::user()]);
    }

    public function create()
    {
        $response = null;
        try {
            $validationRule = [
                'nama' => 'required',
                'email' => 'required',
                'phone' => 'required|min_length[11]',
                'qty' => 'required'
            ];
            if (!$this->validate($validationRule)) {

                return redirect()->back()->with('error', $this->validator->getErrors());
            }
            $request = (object) $this->request->getPost();
            $data = json_decode(json_encode($request), true);
            $wisata = (new WisataModel())->find($data['id']);
            $trans_id = (new TransaksiModel())->insert([
                "slug" => ((int)date('Y')+(int)date('m')+(int)Auth::user()->id+(int)+(int)date('s')+(int)date('i')+(int)date('H')+(int)date('d')),
                "user_id" => Auth::user()->id,
                "amount" => (new WisataModel())->find($data['id'])['harga'] * $data['qty'],
                "status" => 'pending',
                "wisata_id" => $wisata['id']
            ]);

            $transaksi = (new TransaksiModel())->find($trans_id);

            $client = \Config\Services::curlrequest();
            $ClientKey = base64_encode('SB-Mid-server-I0vLSM9n5ZF7MnEvmknDuYzr:SB-Mid-client-39jXTo9ngkmSZeJ2');
            $response = $client
                ->setHeader('Authorization', "Basic $ClientKey")
                ->setHeader('Accept', 'application/json')
                ->setHeader('Content-Type', 'application/json')
                ->setBody(json_encode([
                    "transaction_details" => [
                        'order_id' => $transaksi['slug'],
                        'gross_amount' => $transaksi['amount']
                    ],
                    "credit_card" => [
                        'secure' => true
                    ],
                    'customer_details' => [
                        'first_name' => $data['nama'],
                        'last_name' => '',
                        'email' => $data['email'],
                        'phone' => $data['phone']
                    ],
                    "callbacks" => [
                        "finish" => "http://localhost:8080/",
                    ]
                ]))->post('https://app.sandbox.midtrans.com/snap/v1/transactions');
            $result = json_decode($response->getBody(), true);
            return redirect('dashboard')->with('midtrans', [
                'token' => $result['token'],
                'client_id' => 'SB-Mid-client-39jXTo9ngkmSZeJ2'
            ]);
        } catch (\Throwable $th) {
            echo $th . '<br><br><br><br><br><br><br><br><br><br>';
            try {

                echo ($response->getBody());
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }

    public function check()
    {   
        helper('text');
        $transModel = (new TransaksiModel());
        try {
            $request = (object) $this->request->getGet();
            $data = json_decode(json_encode($request), true);
            $transaksi = $transModel->where('slug', $data['order_id'])->first();
            //dd($transaksi);
            $client = \Config\Services::curlrequest();
            $midtransKey = base64_encode('SB-Mid-server-I0vLSM9n5ZF7MnEvmknDuYzr:SB-Mid-client-39jXTo9ngkmSZeJ2');
            $response = $client
                ->setHeader('Authorization', "Basic $midtransKey")
                ->setHeader('Accept', 'application/json')
                ->setHeader('Content-Type', 'application/json')
                ->get('https://api.sandbox.midtrans.com/v2/' . $data['order_id'] . '/status');
            $result = json_decode($response->getBody(), true);
            $transaksi['midtrans_result'] = $response->getBody();
            $transModel->save($transaksi);
            if ($result['status_code'] == "200") {
                $wisata = (new WisataModel())->find($transaksi['wisata_id']);
                $qty = $transaksi['amount'] / $wisata['harga'];
                for ($i = 0; $i < $qty; $i++) {
                    (new TiketModel())->insert([
                        "user_id" => Auth::user()->id,
                        "wisata_id" =>$wisata['id'],
                        "transaksi_id" => $transaksi['id'],
                        "kode" => ((int)date('Y')+(int)date('m')+(int)Auth::user()->id+(int)$transaksi['id']+(int)$i+(int)date('s')+(int)date('i')+(int)date('H')+(int)date('d')),
                    ]);
                }
                return redirect('dashboard')->with('success', 'Tiket berhasil dibuat');
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return redirect('dashboard')->with('error', 'Tiket gagal dibuat, hubungi admin untuk info lebih lanjut');
    }
}
