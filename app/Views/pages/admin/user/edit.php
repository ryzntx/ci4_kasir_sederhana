<?=$this->section('titlePage');?>
Edit Pengguna | Kelola Pengguna
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
                Edit Pengguna
            </h5>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Terjadi kesalahan!</strong>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?=$error;?></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>
            <form action="<?=base_url('admin/users/update/' . $user[ 'id_user' ]);?>" method="post">
                <?=csrf_field();?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?=$user[ 'nama' ];?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=$user[ 'email' ];?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" id="jabatan" name="jabatan" required>
                        <option value="admin" <?=$user[ 'jabatan' ] == 'admin' ? 'selected' : '';?>>Admin</option>
                        <option value="kasir" <?=$user[ 'jabatan' ] == 'kasir' ? 'selected' : '';?>>Kasir</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?=base_url('admin/users');?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('script');?>
<script>

</script>
<?=$this->endSection();?>