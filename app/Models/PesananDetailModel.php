<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananDetailModel extends Model
{
    protected $table            = 'tb_pesanan_detail';
    protected $primaryKey       = 'pesanan_detail_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['pesanan_id', 'barang_id', 'barang_jml'];

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

    public function take($pesanan_id = 0){
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->where('pesanan_id', $pesanan_id)->where('tb_pesanan_detail.deleted_at', NULL)->join('tb_barang', 'tb_pesanan_detail.barang_id = tb_barang.barang_id', 'LEFT')->orderBy('tb_pesanan_detail.created_at', 'DESC');
        $res = $builder->get()->getResult('array');
        return $res;
    }
}
