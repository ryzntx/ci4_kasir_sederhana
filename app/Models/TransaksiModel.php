<?php
namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table         = 'transaksi';
    protected $primaryKey    = 'id_transaksi';
    protected $allowedFields = [ 'kode_transaksi', 'total_belanja', 'jenis_pembayaran', 'tunai', 'kembalian', 'tanggal', 'id_user' ];
}
