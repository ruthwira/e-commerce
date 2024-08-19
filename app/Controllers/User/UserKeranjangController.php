<?php

namespace App\Controllers\User;

use App\Models\Flasher;
use App\Models\BarangModel;
use App\Controllers\BaseController;
use App\Models\KeranjangModel;

session();
class UserKeranjangController extends BaseController
{

    public function index()
    {
        $user_id = $_SESSION['auth']['user_id'];
        $data = [];
        $data['sidebar'] = 'keranjang';
        $data['title'] = 'Keranjang';
        $data['barangs'] = (new KeranjangModel)->take($user_id);
        return view('user/keranjang/index', $data);
    }

    public function aksi_add_keranjang(){
        $data = $this->request->getVar();
        $user_id = $_SESSION['auth']['user_id'];
        $barangModel = new BarangModel();
        $barang = $barangModel->find($data['barang_id']);
        if ($barang) {
            $payload = [
                'user_id' => $user_id,
                'barang_id' => $data['barang_id'],
                'stock' => $data['stock']
            ];
            $keranjangModel = new KeranjangModel();
            $keranjang = $keranjangModel->where('user_id', $user_id)->where('barang_id', $data['barang_id'])->first();
            if($keranjang){
                $update = $keranjangModel->update($keranjang['keranjang_id'], $payload);
                if($update){
                    Flasher::setFlash('Keranjang berhasil diupdate', 'success');
                }else{
                    Flasher::setFlash('Keranjang gagal diupdate', 'warning');
                }
            }else{
                $insert = $keranjangModel->insert($payload);
                if ($insert) {
                    Flasher::setFlash('Keranjang berhasil disimpan', 'success');
                } else {
                    Flasher::setFlash('Keranjang gagal disimpan', 'warning');
                }
            }
        } else {
            Flasher::setFlash('Barang tidak ditemukan', 'warning');
        }
        return redirect()->to('user/keranjang');
    }

    public function aksi_delete_keranjang(){
        $data = $this->request->getVar();
        $keranjangModel = new KeranjangModel();
        $keranjang = $keranjangModel->find($data['keranjang_id']);
        if ($keranjang) {
            $delete = $keranjangModel->delete($data['keranjang_id']);
            if ($delete) {
                Flasher::setFlash('Keranjang berhasil dihapus', 'success');
            } else {
                Flasher::setFlash('Keranjang gagal dihapus', 'warning');
            }
        } else {
            Flasher::setFlash('Keranjang tidak ditemukan', 'warning');
        }
        return redirect()->to('user/keranjang');
    }

}
