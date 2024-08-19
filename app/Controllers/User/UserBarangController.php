<?php

namespace App\Controllers\User;

use App\Models\Flasher;
use App\Models\BarangModel;
use App\Controllers\BaseController;

session();
class UserBarangController extends BaseController
{
    public function view_barang($barang_id)
    {
        $barang = (new BarangModel())->find($barang_id);
        if ($barang) {
            $data = [];
            $data['sidebar'] = 'barang';
            $data['title'] = 'View Barang';
            $data['barang'] = $barang;
            return view('user/barang/view', $data);
        } else {
            Flasher::setFlash('Barang tidak ditemukan', 'warning');
            return redirect()->to('user');
        }
    }
}
