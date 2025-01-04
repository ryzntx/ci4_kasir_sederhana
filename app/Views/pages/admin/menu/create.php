<?=$this->section('titlePage');?>
Tambah Menu Baru | Kelola Menu
<?=$this->endSection();?>
<?=$this->extend('layouts/main');?>
<?=$this->section('content');?>
<!-- Main Content -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Menu</h1>
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
                Tambah Menu Baru
            </h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>Info!</strong> Silahkan isi form di bawah ini untuk menambahkan menu baru.
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

            <form action="<?=base_url('admin/menu/store');?>" method="post" enctype="multipart/form-data">
                <?=csrf_field();?>
                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu" required
                        value="<?=old('nama_menu');?>">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="harga" name="harga" required
                            value="<?=old('harga');?>">
                    </div>

                </div>
                <div class="mb-3">
                    <label for="jenis_menu" class="form-label">Jenis Menu</label>
                    <select class="form-select" id="jenis_menu" name="jenis_menu" required>
                        <option value="makanan" <?=old('jenis_menu') == 'makanan' ? 'selected' : '';?>>Makanan</option>
                        <option value="minuman" <?=old('jenis_menu') == 'minuman' ? 'selected' : '';?>>Minuman</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="foto_menu" class="form-label">Foto Menu</label>
                    <input type="file" class="form-control" id="foto_menu" name="foto_menu" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection();?>
<?=$this->section('script');?>
<script>

</script>
<?=$this->endSection();?>