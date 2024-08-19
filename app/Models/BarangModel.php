<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'tb_barang';
    protected $primaryKey       = 'barang_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['barang_name', 'barang_remarks', 'barang_kategori', 'barang_harga', 'barang_stock', 'barang_gambar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTotalBarang()
    {
        return $this->countAll(); // Mengasumsikan Anda ingin mendapatkan total jumlah baris dalam tabel
    }
    public function getBestSellerProducts()
    {
        // Implementasikan logika untuk mengambil produk best seller dari database
        // Misalnya, menggunakan query atau ORM

        // Contoh data statis, gantilah dengan logika sesuai kebutuhan Anda
        return $this->select('barang_name, barang_harga, barang_stock, barang_gambar')
            ->orderBy('barang_stock', 'desc')
            ->limit(3) // Ambil 3 produk best seller
            ->findAll();
    }
}
