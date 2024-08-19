<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table            = 'tb_keranjang';
    protected $primaryKey       = 'keranjang_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'barang_id', 'stock'];

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
}
