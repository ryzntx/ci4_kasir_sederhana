<?=$this->extend('layouts/main');?>
<?=$this->section('titlePage');?>
Riwayat Transaksi
<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Riwayat Transaksi</h1>
</div>

<div class="main flex-grow-1">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="table-transaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Total Belanja</th>
                            <th>Jenis Pembayaran</th>
                            <th>Tunai</th>
                            <th>Kembalian</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;foreach ($transaksi as $item): ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$item[ 'kode_transaksi' ];?></td>
                            <td><?=number_format($item[ 'total_belanja' ], 0, ',', '.');?></td>
                            <td><?=$item[ 'jenis_pembayaran' ];?></td>
                            <td><?=number_format($item[ 'tunai' ], 0, ',', '.');?></td>
                            <td><?=number_format($item[ 'kembalian' ], 0, ',', '.');?></td>
                            <td><?=$item[ 'tanggal' ];?></td>
                            <td>
                                <a href="<?=base_url('kasir/transaksi/print/' . $item[ 'id_transaksi' ]);?>"
                                    target="_blank" class="btn btn-sm btn-secondary">Print</a>
                                <a href="<?=base_url('kasir/transaksi/show/' . $item[ 'id_transaksi' ]);?>"
                                    class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('script');?>
<script type="module">
import language from '<?=base_url('assets/vendor/datatables/i18n/indonesian.mjs');?>'
$(document).ready(function() {
    // DataTable
    $('#table-transaksi').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        autoWidth: true,
        responsive: true,
        language: language,
        dom: "<'row'<'col-sm-6'<'row gap-2'<'col-sm-12'B><'col-sm-12'l>>><'col-sm-6 align-self-center'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row justify-content-between'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-auto'p>>",
        buttons: [{
            extend: 'excel',
            title: 'Data Transaksi',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            extend: 'pdf',
            title: 'Data Transaksi',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            extend: 'print',
            title: 'Data Transaksi',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            },
            autoPrint: true,
        }],
    });
});
</script>
<?=$this->endSection();?>