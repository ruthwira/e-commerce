<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\PesananModel;
use App\Models\AkunModel;
use App\Models\Flasher;

class AdminController extends BaseController
{
    public function index()
    {
        // Memanggil session di dalam method atau fungsi
        session();

        $akunModel = new AkunModel();
        $data['total_users'] = $akunModel->getTotalUsers();
        
        $barangModel = new BarangModel();
        $data['total_barang'] = $barangModel->getTotalBarang();
        $data['sidebar'] = 'item'; // Atau 'dashboard' sesuai kebutuhan

        $PesananModel = new PesananModel();
        $data['total_orders_per_month'] = $PesananModel->getTotalOrdersPerMonth();

        

        return view('admin/index', $data);
    }
}
