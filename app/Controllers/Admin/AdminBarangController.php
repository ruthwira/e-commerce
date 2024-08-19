<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\Flasher;

session();
class AdminBarangController extends BaseController
{
    public function index()
    {
        $data = [];
        $data['sidebar'] = 'barang';
        $data['title'] = 'Dashboard Item';
        $data['barangs'] = (new BarangModel())->findAll();
        return view('admin/barang/index', $data);
    }
    public function add_barang()
    {
        $data = [];
        $data['sidebar'] = 'barang';
        $data['title'] = 'Add Item';
        return view('admin/barang/add', $data);
    }
    public function view_barang($barang_id)
    {
        $barang = (new BarangModel())->find($barang_id);
        if($barang){
            $data = [];
            $data['sidebar'] = 'barang';
            $data['title'] = 'View Item';
            $data['barang'] = $barang;
            return view('admin/barang/view', $data);
        }else{
            Flasher::setFlash('Barang tidak ditemukan', 'warning');
            return redirect()->to('admins/barang');
        }
    }

    public function aksi_add_barang()
    {
        $data = $this->request->getVar();
        $barangModel = new BarangModel();
        $data = $this->request->getVar();
        $img = $this->request->getFile('barang_gambar');
        if ($img->getError() == 4) {
            $data['barang_gambar'] = '';
        } else {
            if (!$img->hasMoved()) {
                $filename = $img->getRandomName();
                $isUploaded =  $img->move(FCPATH . 'uploads/barang', $filename);
                if ($isUploaded) {
                    $data['barang_gambar'] = $filename;
                } else {
                    $data['barang_gambar'] = '';
                }
            }
        }
        $barang = $barangModel->insert($data);
        if ($barang) {
            Flasher::setFlash('Barang berhasil disimpan', 'success');
            return redirect()->to('admins/barang/view/' . $barang);
        } else {
            Flasher::setFlash('Barang gagal disimpan', 'warning');
            return redirect()->to('admins/barang');
        }
    }

    public function aksi_update_barang(){
        $barangModel = new BarangModel();
        $data = $this->request->getVar();
        $img = $this->request->getFile('barang_gambar');

        $barang = $barangModel->find($data['barang_id']);
        if ($barang) {
            if ($img->getError() == 4) {
                $data['barang_gambar'] = $barang['barang_gambar'];
            } else {
                if (!$img->hasMoved()) {
                    $filename = $img->getRandomName();
                    $isUploaded =  $img->move(FCPATH . 'uploads/barang', $filename);
                    if ($isUploaded) {
                        $data['barang_gambar'] = $filename;
                    } else {
                        $data['barang_gambar'] = $barang['barang_gambar'];
                    }
                }
            }
            $update = $barangModel->update($data['barang_id'], $data);
            if ($update) {
                Flasher::setFlash('Barang berhasil diperbaharui', 'success');
            } else {
                Flasher::setFlash('Barang gagal diperbaharui', 'warning');
            }
            return redirect()->to('admins/barang/view/' . $data['barang_id']);
        } else {
            Flasher::setFlash('Barang tidak ditemukan', 'warning');
            return redirect()->to('admins/barang');
        }
    }

    public function aksi_delete_barang($barang_id){
        $barangModel = new BarangModel();
        $barang = $barangModel->find($barang_id);
        if ($barang) {
            $barangModel->delete($barang_id);
            Flasher::setFlash('Barang berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Barang tidak ditemukan', 'warning');
        }
        return redirect()->to('admins/barang');
    }
}
