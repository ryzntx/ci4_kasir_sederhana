<?php
namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table         = 'detail_transaksi';
    protected $primaryKey    = 'id_detail_transaksi';
    protected $allowedFields = [ 'id_transaksi', 'id_menu', 'qty', 'total_harga' ];

    public function getDetailTransaksi($id_transaksi)
    {
        return $this->db->table($this->table)
            ->select('detail_transaksi.*, menu.nama_menu, menu.harga')
            ->join('menu', 'menu.id_menu = detail_transaksi.id_menu')
            ->where('id_transaksi', $id_transaksi)
            ->get()
            ->getResultArray();
    }
}
