<?=$this->extend('layouts/main');?>
<?=$this->section('titlePage');?>
Laporan Transaksi
<?=$this->endSection();?>
<?=$this->section('content');?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Laporan Transaksi</h1>
    <div class="btn-toolbar mb-2 mb-md-0 gap-2">
        <?php if (request()->getGet()): ?>
        <a href="<?=base_url('kasir/laporan');?>" class="btn btn-sm btn-outline-danger">
            <i class="fa fa-xmark me-2"></i>
            Reset Data
        </a>
        <?php endif;?>
        <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#filterCanvas"
            aria-controls="filterCanvas">
            <i class="fa fa-filter me-2"></i>
            Filter
        </a>
        <!-- <a href="#" target="_blank" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-print me-2"></i>
            Print
        </a> -->
    </div>
</div>

<div class="main flex-grow-1">
    <div class="row mb-4 gap-3 gap-md-0">
        <div class="col-12 col-md-4">
            <div class="card p-3">

                <h5>Total Keseluruhan Transaksi</h5>


                <h2><?=number_format($total_transaksi, 0, ',', '.');?>
                    <?php if ($total_transaksi_hari_ini > 0): ?>
                    <small class="text-success">+<?=number_format($total_transaksi_hari_ini, 0, ',', '.');?></small>
                    <?php endif;?>
                </h2>

            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-3">

                <h5>Total Transaksi Hari Ini</h5>


                <h2 class="text-success">+<?=number_format($total_transaksi_hari_ini, 0, ',', '.');?></h2>

            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card p-3">

                <h5>Total Transaksi Bulan Ini</h5>


                <h2><?=number_format($total_transaksi_bulan_ini, 0, ',', '.');?>
                    <?php if ($total_transaksi_hari_ini > 0): ?>
                    <small class="text-success">+<?=number_format($total_transaksi_hari_ini, 0, ',', '.');?></small>
                    <?php endif;?>
                </h2>

            </div>
        </div>
    </div>
    <?php if (request()->getGet()): ?>
    <div class="alert alert-info">
        Menampilkan data transaksi berdasarkan filter yang dipilih
        <ul>
            <?php if (request()->getGet('bulan')): ?>
            <li>Bulan: <?=date('F', mktime(0, 0, 0, request()->getGet('bulan'), 1));?></li>
            <?php endif;?>
            <?php if (request()->getGet('tahun')): ?>
            <li>Tahun: <?=request()->getGet('tahun');?></li>
            <?php endif;?>
            <?php if (request()->getGet('tanggal')): ?>
            <li>Rentang Tanggal: <?=request()->getGet('tanggal');?></li>
            <?php endif;?>
            <?php if (request()->getGet('jenis_pembayaran')): ?>
            <li>Jenis Pembayaran: <?=request()->getGet('jenis_pembayaran');?></li>
            <?php endif;?>
            <?php if (request()->getGet('user')): ?>
            <li>Kasir:
                <?=$users[ array_search(request()->getGet('user'), array_column($users, 'id_user')) ][ 'nama' ];?>
            </li>
            <?php endif;?>
        </ul>
    </div>
    <?php endif;?>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;foreach ($transaksis as $item): ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$item[ 'kode_transaksi' ];?></td>
                            <td><?=number_format($item[ 'total_belanja' ], 0, ',', '.');?></td>
                            <td><?=$item[ 'jenis_pembayaran' ];?></td>
                            <td><?=number_format($item[ 'tunai' ], 0, ',', '.');?></td>
                            <td><?=number_format($item[ 'kembalian' ], 0, ',', '.');?></td>
                            <td><?=$item[ 'tanggal' ];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Filter -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterCanvas" aria-labelledby="filterCanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterCanvasLabel">Filter Laporan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="<?=base_url('kasir/laporan');?>" method="get">
            <h5 class="m-0">Filter Waktu</h5>
            <small class="text-danger">Pilihlah berdasarkan bulan dan tahun, atau berdasarkan tanggal</small>
            <hr class="mt-0 border-bottom border-1 border-black">
            <div class="row">
                <div class="mb-3 col-12 col-md-6">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="">-- Pilih Bulan --</option>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option <?=request()->getGet('bulan') == $i ? 'selected' : '';?> value="<?=$i;?>">
                            <?=date('F', mktime(0, 0, 0, $i, 1));?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="mb-3 col-12 col-md-6">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select class="form-select" id="tahun" name="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        <?php for ($i = 2021; $i <= date('Y'); $i++): ?>
                        <option <?=request()->getGet('tahun') == $i ? 'selected' : '';?> value="<?=$i;?>"><?=$i;?>
                        </option>
                        <?php endfor;?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Rentang Tanggal</label>
                <input type="text" class="form-control daterange" id="tanggal" name="tanggal"
                    value="<?=request()->getGet('tanggal');?>" placeholder="-- Pilih Tanggal --">
            </div>
            <hr class="mt-0 border-bottom border-1 border-black">
            <h5 class="m-0 p-0">Filter Data</h5>
            <hr class="mt-0 border-bottom border-1 border-black">
            <div class="mb-3">
                <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran">
                    <option value="">-- Pilih Jenis Pembayaran --</option>
                    <option <?=request()->getGet('jenis_pembayaran') == 'Tunai' ? 'selected' : '';?> value="Tunai">
                        Tunai</option>
                    <option <?=request()->getGet('jenis_pembayaran') == 'Debit' ? 'selected' : '';?> value="Debit">
                        Debit</option>
                    <option <?=request()->getGet('jenis_pembayaran') == 'QRIS' ? 'selected' : '';?> value="QRIS">QRIS
                    </option>
                    <option <?=request()->getGet('jenis_pembayaran') == 'OVO' ? 'selected' : '';?> value="OVO">OVO
                    </option>
                    <option <?=request()->getGet('jenis_pembayaran') == 'GoPay' ? 'selected' : '';?> value="GoPay">GoPay
                    </option>
                    <option <?=request()->getGet('jenis_pembayaran') == 'Dana' ? 'selected' : '';?> value="Dana">Dana
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Kasir</label>
                <select class="form-select" id="user" name="user">
                    <option value="">-- Pilih Kasir --</option>
                    <?php foreach ($users as $user): ?>
                    <option <?=request()->getGet('user') == $user[ 'id_user' ] ? 'selected' : '';?>
                        value="<?=$user[ 'id_user' ];?>"><?=$user[ 'nama' ];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>
<!-- Offcanvas Filter -->
<?=$this->endSection();?>
<?=$this->section('script');?>
<script type="module">
import language from '<?=base_url('assets/vendor/datatables/i18n/indonesian.mjs');?>'

var message = '';

<?php if (request()->getGet('bulan')): ?>
message += 'Laporan Transaksi Bulan <?=date('F', mktime(0, 0, 0, request()->getGet('bulan'), 1));?>\n';
<?php if (request()->getGet('tahun')): ?>
message += 'Tahun <?=request()->getGet('tahun');?>\n';
<?php endif;?>
<?php elseif (request()->getGet('tahun')): ?>
message += 'Laporan Transaksi Tahun <?=request()->getGet('tahun');?>\n';
<?php elseif (request()->getGet('tanggal')): ?>
message += 'Laporan Transaksi Tanggal <?=request()->getGet('tanggal');?>\n';
<?php endif;?>

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
            messageTop: message,
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            extend: 'pdf',
            title: 'Data Transaksi',
            messageTop: message,
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            }
        }, {
            extend: 'print',
            title: 'Data Transaksi',
            messageTop: message,
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            },
            autoPrint: true,
        }],
    });
});
</script>
<script>
$(document).ready(function() {
    $('input[name="tanggal"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
            'YYYY-MM-DD'));
    });
});
</script>
<?=$this->endSection();?>