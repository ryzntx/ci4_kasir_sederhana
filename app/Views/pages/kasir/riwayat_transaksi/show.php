<?=$this->extend('layouts/main');?>
<?=$this->section('titlePage');?>
Detail Transaksi | Riwayat Transaksi
<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Riwayat Transaksi</h1>
    <div class="btn-toolbar mb-2 mb-md-0 gap-2">
        <a href="<?=base_url('kasir/transaksi');?>" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left me-2"></i>
            Kembali
        </a>
        <a href="<?=base_url('kasir/transaksi/print/' . $transaksi[ 'id_transaksi' ]);?>" target="_blank"
            class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-print me-2"></i>
            Print
        </a>
    </div>
</div>

<div class="main flex-grow-1">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Detail Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th>Kode Transaksi</th>
                            <td><?=$transaksi[ 'kode_transaksi' ];?></td>
                        </tr>
                        <tr>
                            <th>Total Belanja</th>
                            <td><?=number_format($transaksi[ 'total_belanja' ], 0, ',', '.');?></td>
                        </tr>
                        <tr>
                            <th>Jenis Pembayaran</th>
                            <td><?=$transaksi[ 'jenis_pembayaran' ];?></td>
                        </tr>
                        <tr>
                            <th>Tunai</th>
                            <td><?=number_format($transaksi[ 'tunai' ], 0, ',', '.');?></td>
                        </tr>
                        <tr>
                            <th>Kembalian</th>
                            <td><?=number_format($transaksi[ 'kembalian' ], 0, ',', '.');?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?=$transaksi[ 'tanggal' ];?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="table-detail-transaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;foreach ($detailTransaksi as $row): ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$row[ 'nama_menu' ];?></td>
                            <td><?=number_format($row[ 'harga' ], 0, ',', '.');?></td>
                            <td><?=$row[ 'qty' ];?></td>
                            <td><?=number_format($row[ 'total_harga' ], 0, ',', '.');?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection();?>