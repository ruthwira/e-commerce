<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'tb_pesanan';
    protected $primaryKey       = 'pesanan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['pesanan_by', 'pesanan_status', 'pesanan_total', 'pesanan_pembayaran', 'pesanan_path'];

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

    public function take($user_id = 0){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where('tb_keranjang.user_id', $user_id)->where('tb_keranjang.deleted_at', NULL)->join('tb_barang', 'tb_keranjang.barang_id = tb_barang.barang_id', 'LEFT')->orderBy('tb_keranjang.created_at', 'DESC');
        $res = $builder->get()->getResult('array');
        return $res;
    }
    public function getTotalOrdersPerMonth()
    {
        $query = $this->db->query("SELECT MONTH(created_at) as month, COUNT(*) as total FROM tb_pesanan GROUP BY MONTH(created_at)");
        return $query->getResultArray();
}
}