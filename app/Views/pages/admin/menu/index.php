<?=$this->extend('layouts/main');?>
<?=$this->section('titlePage');?>
Kelola Menu
<?=$this->endSection();?>
<?=$this->section('content');?>
<!-- Main Content -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Menu</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?=base_url('admin/menu/create');?>" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-plus me-2"></i>
            Tambah Menu
        </a>
    </div>
</div>

<div class="main flex-grow-1">
    <!-- <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?=session()->getFlashdata('success');?>
    </div>
    <?php endif;?> -->
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?=session()->getFlashdata('error');?>
    </div>
    <?php endif;?>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Daftar Menu</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable">
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
                                <a href="<?=base_url('admin/menu/show/' . $menu[ 'id_menu' ]);?>"
                                    class="btn btn-sm btn-primary">Lihat</a>
                                <a href="<?=base_url('admin/menu/edit/' . $menu[ 'id_menu' ]);?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <a href="#" id="delete" data-id="<?=$menu[ 'id_menu' ];?>"
                                    class="btn btn-sm btn-danger">Hapus</a>
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
<script>
$(document).ready(function() {
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Peringatan',
            text: 'Anda yakin untuk menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "<?=base_url('admin/menu/delete/');?>" + id;
            }
        })

    })
});
</script>
<?=$this->endSection();?>