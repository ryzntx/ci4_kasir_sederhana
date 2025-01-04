<?=$this->section('titlePage');?>
Detail Pengguna | Kelola Pengguna
<?=$this->endSection();?>
<?=$this->extend('layouts/main');?>
<?=$this->section('content');?>
<!-- Main Content -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Pengguna</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?=base_url('admin/users');?>" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left me-2"></i>
            Kembali
        </a>
    </div>
</div>

<div class="main flex-grow-1">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Detail Pengguna
            </h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?=$user[ 'nama' ];?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?=$user[ 'email' ];?>"
                    readonly>
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?=$user[ 'jabatan' ];?>"
                    readonly>
            </div>
            <a href="<?=base_url('admin/users/edit/' . $user[ 'id_user' ]);?>" class="btn btn-primary">Edit</a>
            <a href="#" id="delete" data-id="<?=$user[ 'id_user' ];?>" class="btn btn-danger">Hapus</a>
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
                window.location = "<?=base_url('admin/users/delete/');?>" + id;
            }
        })

    })
});
</script>
<?=$this->endSection();?>