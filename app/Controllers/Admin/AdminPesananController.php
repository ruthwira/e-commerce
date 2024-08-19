<?php

namespace App\Controllers\Admin;

use App\Models\Flasher;
use App\Models\PesananModel;
use App\Controllers\BaseController;
use App\Models\PesananDetailModel;

session();
class AdminPesananController extends BaseController
{
    public function index()
    {
        $data = [];
        $data['sidebar'] = 'pesanan';
        $data['title'] = 'Dashboard Pesanan';
        $data['pesanans'] = (new PesananModel())->findAll();
        return view('admin/pesanan/index', $data);
    }
    public function view_pesanan($pesanan_id)
    {
        $data = [];
        $data['sidebar'] = 'pesanan';
        $data['title'] = 'View Pesanan';
        $data['pesanan'] = (new PesananModel)->join('tb_user', 'tb_pesanan.pesanan_by = tb_user.user_id')->find($pesanan_id);
        $data['barangs'] = (new PesananDetailModel())->take($pesanan_id);
        return view('admin/pesanan/view', $data);
    }

    public function aksi_update_pesanan()
    {
        $data = $this->request->getVar();
        $pesanan = (new PesananModel)->find($data['pesanan_id']);
        if($pesanan){
            $pesanan['pesanan_status'] = $data['pesanan_status'];
            $update = (new PesananModel)->update($data['pesanan_id'], $pesanan);
            if($update){
                Flasher::setFlash('Pesanan berhasil diupdate', 'success');
            }else{
                Flasher::setFlash('Pesanan gagal diupdate', 'warning');
            }
            return redirect()->to('admins/pesanan/view/' . $data['pesanan_id']);
        }else{
            Flasher::setFlash('Pesanan tidak ditemukan', 'warning');
            return redirect()->to('admins/pesanan');
        }
    }

    public function aksi_delete_pesanan()
    {
    }
}
