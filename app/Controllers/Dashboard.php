<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        $totalProducts = $productModel->countAllResults();
        $totalTransactions = $saleModel->countAllResults();
        $revenueSum = $saleModel->selectSum('total')->first();
        $totalRevenue = $revenueSum['total'] ?? 0;

        $recentSales = $saleModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        $chart_labels = [];
        $chart_data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            $chart_labels[] = date('D', strtotime($date)); 

            $query = $saleModel->where('DATE(created_at)', $date)->selectSum('total')->first();
            
            $chart_data[] = (float)($query['total'] ?? 0);
        }

        $data = [
            'total_products'     => $totalProducts,
            'total_transactions' => $totalTransactions,
            'total_revenue'      => $totalRevenue,
            'recent_sales'       => $recentSales,
            'chart_labels'       => $chart_labels, 
            'chart_data'         => $chart_data    
        ];

        return view('dashboard', $data);
    }
}