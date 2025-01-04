<?=$this->section('titlePage');?>
Tambah Pengguna Baru | Kelola Pengguna
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
                Tambah Pengguna Baru
            </h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>Info!</strong> Silahkan isi form di bawah ini untuk menambahkan pengguna baru.
            </div>

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

            <form action="<?=base_url('admin/users/store');?>" method="post">
                <?=csrf_field();?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required value="<?=old('nama');?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        value="<?=old('email');?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select" id="jabatan" name="jabatan" required>
                        <option value="admin" <?=old('jabatan') == 'admin' ? 'selected' : '';?>>Admin</option>
                        <option value="kasir" <?=old('jabatan') == 'kasir' ? 'selected' : '';?>>Kasir</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('script');?>
<script>

</script>
<?=$this->endSection();?>