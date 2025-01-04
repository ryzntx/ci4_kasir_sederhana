<?=$this->section('titlePage');?>
Beranda
<?=$this->endSection();?>
<?=$this->extend('layouts/main');?>
<?=$this->section('content');?>
<!-- Main Content -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Beranda</h1>
</div>

<div class="main flex-grow-1">

    <!-- Cards -->
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

    <!-- Charts -->
    <div class="row mb-4 gap-3 gap-md-0">
        <div class="col-12 col-md-6">
            <div class="card p-3">
                <h5>Data Transaksi Per Bulan</h5>
                <canvas id="transaksiBulanChart"></canvas>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card p-3">
                <h5>Data Transaksi Per Tahun</h5>
                <canvas id="transaksiTahunChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row mb-4 gap-3 gap-md-0">
        <div class="col-12 col-md-6">
            <div class="card p-3">
                <h5>Data Transaksi Per Kasir</h5>
                <canvas id="transaksiKasirChart"></canvas>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card p-3">
                <h5>Data Transaksi Per Menu</h5>
                <canvas id="transaksiMenuChart"></canvas>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('script');?>
<!-- Script untuk Chart.js -->
<script>
// Initialize Chart
const transaksiBulanCtx = document.getElementById('transaksiBulanChart').getContext('2d');
const transaksiTahunCtx = document.getElementById('transaksiTahunChart').getContext('2d');
const transaksiKasirCtx = document.getElementById('transaksiKasirChart').getContext('2d');
const transaksiMenuCtx = document.getElementById('transaksiMenuChart').getContext('2d');

// Initialize Months
const month = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];

// Initialize Years
const years = [];
for (let year = 2021; year <= new Date().getFullYear(); year++) {
    years.push(year);
}

// Initialize Kasir
const kasir = {};
<?php foreach ($users as $key => $val): ?>
kasir[<?=$val[ 'id_user' ];?>] = '<?=$val[ 'nama' ];?>';
<?php endforeach;?>

// Initialize Menu
const menu = {};
<?php foreach ($menu as $key => $val): ?>
menu[<?=$val[ 'id_menu' ];?>] = '<?=$val[ 'nama_menu' ];?>';
<?php endforeach;?>

// Initialize Data
const transaksiBulanData = new Array(12).fill(0);
<?php foreach ($transaksi_bulan as $key => $val): ?>
transaksiBulanData[<?=$val[ 'month' ] - 1;?>] = <?=$val[ 'total' ];?>;
<?php endforeach;?>

const transaksiTahunData = new Array(years.length).fill(0);
<?php foreach ($transaksi_tahun as $key => $val): ?>
transaksiTahunData[<?=$val[ 'year' ] - 2021;?>] = <?=$val[ 'total' ];?>;
<?php endforeach;?>

const transaksiKasirData = {};
<?php foreach ($transaksi_user as $key => $val): ?>
transaksiKasirData[<?=$val[ 'id_user' ];?>] = <?=$val[ 'total' ];?>;
<?php endforeach;?>

const transaksiMenuData = {};
<?php foreach ($transaksi_menu as $key => $val): ?>
transaksiMenuData[<?=$val[ 'id_menu' ];?>] = <?=$val[ 'total' ];?>;
<?php endforeach;?>

// Data untuk chart penjualan
new Chart(transaksiBulanCtx, {
    type: 'line',
    data: {
        labels: month,
        datasets: [{
            label: 'Transaksi',
            data: transaksiBulanData,
            backgroundColor: ['#a5b4fc', '#c084fc', '#60a5fa']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return Number.isInteger(value) ? value : null;
                    }
                }
            }
        }
    }
});

// Data untuk chart pembelian

new Chart(transaksiTahunCtx, {
    type: 'line',
    data: {
        labels: years,
        datasets: [{
            label: 'Transaksi',
            data: transaksiTahunData,
            backgroundColor: ['#a5b4fc', '#c084fc', '#60a5fa']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return Number.isInteger(value) ? value : null;
                    }
                }
            }
        }
    }
});

// Data untuk chart kasir
new Chart(transaksiKasirCtx, {
    type: 'bar',
    data: {
        labels: Object.values(kasir),
        datasets: [{
            label: 'Transaksi',
            data: Object.values(transaksiKasirData),
            backgroundColor: ['#a5b4fc', '#c084fc', '#60a5fa']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return Number.isInteger(value) ? value : null;
                    }
                }
            }
        }
    }
});

// Data untuk chart menu

new Chart(transaksiMenuCtx, {
    type: 'bar',
    data: {
        labels: Object.values(menu),
        datasets: [{
            label: 'Transaksi',
            data: Object.values(transaksiMenuData),
            backgroundColor: ['#a5b4fc', '#c084fc', '#60a5fa']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return Number.isInteger(value) ? value : null;
                    }
                }
            }
        }
    }
});
</script>
<?=$this->endSection();?>