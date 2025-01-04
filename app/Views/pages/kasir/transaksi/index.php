<?=$this->extend('layouts/main');?>
<?=$this->section('titlePage');?>
Input Transaksi
<?=$this->endSection();?>
<?=$this->section('content');?>
<!-- Main Content -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Transaksi</h1>
</div>

<div class="main flex-grow-1">
    <!-- Flash Message -->
    <?php if (session('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan!</strong>
        <ul>
            <?php foreach (session('errors') as $error): ?>
            <li><?=$error;?></li>
            <?php endforeach;?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif;?>
    <div class="row gap-3 gap-md-0">
        <!-- Menu Section -->
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Menu</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-wrap" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Jenis menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                <?php foreach ($menus as $menu): ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$menu[ 'nama_menu' ];?></td>
                                    <td><?='Rp ' . number_format($menu[ 'harga' ], 0, ',', '.');?></td>
                                    <td><?=$menu[ 'jenis_menu' ];?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalTambahItem<?=$menu[ 'id_menu' ];?>">Tambahkan</button>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Menu Section -->
        <!-- Order Section -->
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Order</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="dataTableCart">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i     = 1;?>
                                <?php $total = 0;?>
                                <?php foreach ($cart as $key => $value): ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$value[ 'menu' ];?></td>
                                    <td><?='Rp ' . number_format($value[ 'harga' ], 0, ',', '.');?></td>
                                    <td>
                                        <form class="d-flex"
                                            action="<?=base_url('kasir/transaksi/change-quantity-item/' . $key);?>"
                                            method="post">
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                    min="1" required value="<?=$value[ 'jumlah' ];?>">
                                                <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td><?='Rp ' . number_format($value[ 'total' ], 0, ',', '.');?></td>
                                    <td>
                                        <a href="#" id="delete" data-id="<?=$key;?>"
                                            class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                <?php $total += $value[ 'total' ];?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (!empty($cart)): ?>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5><?='Rp ' . number_format($total, 0, ',', '.');?></h5>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="#" id="clearCart" class="btn btn-danger">Batal</a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modalCheckout">Checkout</button>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <!-- End Order Section -->
    </div>
</div>
<!-- End Main Content -->

<!-- Modal Tambahkan Item -->
<?php foreach ($menus as $menu): ?>
<div class="modal fade" id="modalTambahItem<?=$menu[ 'id_menu' ];?>" tabindex="-1"
    aria-labelledby="modalTambahItem<?=$menu[ 'id_menu' ];?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahItem<?=$menu[ 'id_menu' ];?>Label">Tambahkan Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('kasir/transaksi/store');?>" method="post">
                    <input type="hidden" name="id_menu" value="<?=$menu[ 'id_menu' ];?>">
                    <div class="mb-3">
                        <label for="menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="menu" name="menu" readonly
                            value="<?=$menu[ 'nama_menu' ];?>">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" readonly
                            value="<?=$menu[ 'harga' ];?>">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required value="1"
                            autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<!-- End Modal Tambahkan Item -->

<!-- Modal Checkout -->
<div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckoutLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCheckoutLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('kasir/transaksi/checkout');?>" method="post">
                <?=csrf_field();?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="text" class="form-control" id="total" name="total" readonly
                            value="<?='Rp ' . number_format($total, 0, ',', '.');?>">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                        <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran" required>
                            <option value="">Pilih Jenis Pembayaran</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Debit">Debit</option>
                            <option value="QRIS">QRIS</option>
                            <option value="OVO">OVO</option>
                            <option value="GoPay">GoPay</option>
                            <option value="Dana">Dana</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bayar" class="form-label">Bayar</label>
                        <input type="number" class="form-control" id="bayar" name="bayar" min="<?=$total;?>" required
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kembali" class="form-label">Kembali</label>
                        <input type="text" class="form-control" id="kembali" name="kembali" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Checkout -->
<?=$this->endSection();?>
<?=$this->section('script');?>
<script type="module">
import language from '<?=base_url('assets/vendor/datatables/i18n/indonesian.mjs');?>'
$(document).ready(function() {
    // DataTable
    $('#dataTableCart').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        autoWidth: true,
        responsive: true,
        language: language,
    });
});
</script>
<script>
$(document).ready(function() {
    <?php if (session('print')): ?>
    window.open('<?=base_url('kasir/transaksi/print/' . session('print'));?>', '_blank');
    <?php endif;?>

    $('#jenis_pembayaran').change(function() {
        var jenis_pembayaran = $(this).val();
        if (jenis_pembayaran == 'Tunai') {
            $('#bayar').prop('readonly', false);
        } else if (jenis_pembayaran == '') {
            $('#bayar').prop('readonly', true);
            $('#bayar').val('');
            $('#kembali').val('');

        } else {
            $('#bayar').prop('readonly', true);
            $('#bayar').val(<?=$total;?>);
            $('#kembali').val('Rp 0');
        }
    });

    $(document).on('input', '#bayar', function() {
        var total = <?=$total;?>;
        var bayar = $(this).val();
        var kembali = bayar - total;
        $('#kembali').val('Rp ' + kembali.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
    });

    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin untuk menghapus item ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?=base_url('kasir/transaksi/delete/item/');?>' + id;
            }
        })

    })

    $(document).on('click', '#clearCart', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Peringatan',
            text: 'Apakah anda yakin untuk membatalkan order ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Batalkan!',
            cancelButtonText: 'Tidak',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?=base_url('kasir/transaksi/clear-cart');?>';
            }
        })

    })
});
</script>
<?=$this->endSection();?>