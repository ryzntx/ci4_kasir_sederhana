<?=$this->section('titlePage');?>
Detail Menu | Kelola Menu
<?=$this->endSection();?>
<?=$this->extend('layouts/main');?>
<?=$this->section('content');?>
<!-- Main Content -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Pengguna</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?=base_url('admin/menu');?>" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>
</div>

<div class="main flex-grow-1">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Detail Menu
            </h5>
        </div>
        <div class="card-body">
            <img src="<?=base_url($menu[ 'foto_menu' ]);?>" alt="<?=$menu[ 'nama_menu' ];?>" class="img-thumbnail"
                width="100" readonly>
            <div class="mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                    value="<?=$menu[ 'nama_menu' ];?>" readonly>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga"
                    value="<?='Rp ' . number_format($menu[ 'harga' ], 0, ',', '.');?>" readonly>
            </div>
            <div class="mb-3">
                <label for="jenis_menu" class="form-label">Jenis Menu</label>
                <input type="text" class="form-control" id="jenis_menu" name="jenis_menu"
                    value="<?=$menu[ 'jenis_menu' ];?>" readonly>
            </div>
            <a href="<?=base_url('admin/menu/edit/' . $menu[ 'id_menu' ]);?>" class="btn btn-primary">Edit</a>
            <a href="#" id="delete" data-id="<?=$menu[ 'id_menu' ];?>" class="btn btn-danger">Hapus</a>
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