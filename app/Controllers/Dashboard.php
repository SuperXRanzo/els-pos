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
        
        // Get low stock products (stock < 5)
        $lowStockProducts = $productModel->where('stock <', 5)->orderBy('stock', 'ASC')->findAll();

        $chart_labels = [];
        $chart_data = [];
        $chart_data_transactions = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            $chart_labels[] = date('D', strtotime($date)); 

            $query = $saleModel->where('DATE(created_at)', $date)->selectSum('total')->first();
            $chart_data[] = (float)($query['total'] ?? 0);
            
            // Get transaction count for the date
            $txnCount = $saleModel->where('DATE(created_at)', $date)->countAllResults();
            $chart_data_transactions[] = (int)$txnCount;
        }

        $data = [
            'total_products'     => $totalProducts,
            'total_transactions' => $totalTransactions,
            'total_revenue'      => $totalRevenue,
            'recent_sales'       => $recentSales,
            'low_stock_products' => $lowStockProducts,
            'chart_labels'       => $chart_labels, 
            'chart_data'         => $chart_data,
            'chart_data_transactions' => $chart_data_transactions,
            'username'           => session()->get('username')
        ];

        return view('dashboard', $data);
    }
}