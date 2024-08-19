<?php

namespace App\Controllers\User;

use App\Models\Flasher;
use App\Models\KeranjangModel;
use App\Controllers\BaseController;
use App\Models\PesananDetailModel;
use App\Models\PesananModel;

session();
class UserPesananController extends BaseController
{
    public function index()
    {
        $user_id = $_SESSION['auth']['user_id'];
        $data = [];
        $data['sidebar'] = 'item';
        $data['title'] = 'Dashboard Pesanan';
        $data['pesanans'] = (new PesananModel())->where('pesanan_by', $user_id)->findAll();
        return view('user/pesanan/index', $data);
    }
    public function view_pesanan($pesanan_id)
    {
        $pesanan = (new PesananModel)->find($pesanan_id);
        if($pesanan){
            $data = [];
            $data['sidebar'] = 'item';
            $data['title'] = 'View Pesanan';
            $data['pesanan'] = (new PesananModel)->join('tb_user', 'tb_pesanan.pesanan_by = tb_user.user_id')->find($pesanan_id);
            $data['barangs'] = (new PesananDetailModel())->take($pesanan_id);
            return view('user/pesanan/view', $data);
        }else{
            Flasher::setFlash('Pesanan tidak ditemukan', 'warning');
            return redirect()->to('user/pesanan');
        }
    }

    public function aksi_add_pesanan()
    {
        $data = $this->request->getVar();
        $user_id = $_SESSION['auth']['user_id'];
        $barangs = (new KeranjangModel)->take($user_id);
        $keranjang_ids = array_column($barangs, 'keranjang_id');
        $payload = [];
        $payload['pesanan_by'] = $user_id;
        $payload['pesanan_status'] = 0;
        $payload['pesanan_total'] = $data['pesanan_total'];
        $payload['pesanan_pembayaran'] = $data['pesanan_pembayaran'];
        $pesanan = (new PesananModel())->insert($payload);
        if($pesanan){
            foreach ($barangs as $key => $barang) {
                $payload2 = [];
                $payload2['pesanan_id'] = $pesanan;
                $payload2['barang_id'] = $barang['barang_id'];
                $payload2['barang_jml'] = $barang['stock'];
                $detail = (new PesananDetailModel())->insert($payload2);
            }
            (new KeranjangModel())->delete($keranjang_ids);
            Flasher::setFlash('Pesanan berhasil dibuat', 'success');
            return redirect()->to('user/pesanan/view/' . $pesanan);
        }else{
            Flasher::setFlash('Pesanan gagal dibuat', 'warning');
            return redirect()->to('user/keranjang');
        }
    }

    public function aksi_update_pesanan()
    {
        $data = $this->request->getVar();
        $pesanan = (new PesananModel)->find($data['pesanan_id']);
        if($pesanan){
            if($pesanan['pesanan_status'] == 0){
                // Upload bukti dulu
                $img = $this->request->getFile('pesanan_path');
                if($img){
                    if ($img->getError() != 4) {
                        if (!$img->hasMoved()) {
                            $filename = $img->getRandomName();
                            $isUploaded =  $img->move(FCPATH . 'uploads/bukti', $filename);
                            if ($isUploaded) {
                                $pesanan['pesanan_path'] = $filename;
                            } else {
                                $pesanan['pesanan_path'] = '';
                            }
                        }
                    }else{
                        Flasher::setFlash('Pesanan gagal diupdate karena bukti transaksi tidak ditemukan', 'warning');
                        return redirect()->to('user/pesanan/view/' . $data['pesanan_id']);
                    }
                }else{
                    Flasher::setFlash('Pesanan gagal diupdate karena bukti transaksi tidak ditemukan', 'warning');
                    return redirect()->to('user/pesanan/view/' . $data['pesanan_id']);
                }
                $pesanan['pesanan_status'] = 1;
            }else{
                $pesanan['pesanan_status'] = $data['pesanan_status'];
            }
            $update = (new PesananModel)->update($data['pesanan_id'], $pesanan);
            if($update){
                Flasher::setFlash('Pesanan berhasil diupdate', 'success');
            }else{
                Flasher::setFlash('Pesanan gagal diupdate', 'warning');
            }
            return redirect()->to('user/pesanan/view/' . $data['pesanan_id']);
        }else{
            Flasher::setFlash('Pesanan tidak ditemukan', 'warning');
            return redirect()->to('user/pesanan');
        }
    }

    public function aksi_konfirmasi_pesanan(){
        $data = $this->request->getVar();
        $pesanan = (new PesananModel)->find($data['pesanan_id']);
        if ($pesanan) {
            $pesanan['pesanan_status'] = 4;
            $update = (new PesananModel)->update($data['pesanan_id'], $pesanan);
            if ($update) {
                Flasher::setFlash('Pesanan berhasil diterima', 'success');
            } else {
                Flasher::setFlash('Pesanan gagal diterima', 'warning');
            }
            return redirect()->to('user/pesanan/view/' . $data['pesanan_id']);
        } else {
            Flasher::setFlash('Pesanan tidak ditemukan', 'warning');
            return redirect()->to('user/pesanan');
        }
    }

    public function aksi_delete_pesanan()
    {
    }
}
