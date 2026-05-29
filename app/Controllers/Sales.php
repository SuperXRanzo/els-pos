<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;

class Sales extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        $saleModel = new SaleModel();
        $data['sales'] = $saleModel->orderBy('created_at', 'DESC')->findAll();
        return view('sales_list', $data);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        $productModel = new ProductModel();
        $data['products'] = $productModel->where('stock >', 0)->findAll();
        $data['invoice'] = 'INV-' . date('YmdHis');
        return view('sales_create', $data);
    }

    public function store()
    {
        $json = $this->request->getJSON(true);
        $cart = $json['cart'] ?? [];

        if (empty($cart)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Keranjang kosong!']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $saleModel = new SaleModel();
        $detailModel = new SaleDetailModel();
        $productModel = new ProductModel();

        $saleId = $saleModel->insert([
            'invoice'       => $json['invoice'],
            'total'         => $json['total'],
            'cash_paid'     => $json['cash'],
            'change_amount' => $json['change']
        ]);

        foreach ($cart as $item) {
            $detailModel->insert([
                'sale_id'    => $saleId,
                'product_id' => $item['product_id'],
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'subtotal'   => $item['subtotal']
            ]);

            $product = $productModel->find($item['product_id']);
            if ($product) {
                $productModel->update($item['product_id'], [
                    'stock' => $product['stock'] - $item['qty']
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal simpan database']);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Transaksi Berhasil!']);
    }
}