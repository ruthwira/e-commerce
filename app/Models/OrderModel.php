
namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'tb_orders'; // ganti dengan nama tabel pesanan Anda
    // konfigurasi lainnya...

    public function getTotalOrdersPerMonth()
    {
        $query = $this->db->query("SELECT MONTH(created_at) as month, COUNT(*) as total FROM tb_orders GROUP BY MONTH(created_at)");
        return $query->getResultArray();
    }
}
