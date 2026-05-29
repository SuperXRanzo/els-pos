<?php
namespace App\Models;
use CodeIgniter\Model;

class SaleModel extends Model {
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $allowedFields = ['invoice', 'total', 'cash_paid', 'change_amount', 'created_at'];
}