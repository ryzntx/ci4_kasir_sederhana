<div class="d-flex flex-column flex-shrink-0 sidebar border border-right col-md-3 col-lg-2 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
            <use xlink:href="#bootstrap" />
        </svg>
        <span class="fs-4">Sidebar</span>
    </a>
    <hr> -->
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Saung Lebe</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-3 overflow-y-auto">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>Hi, <?=model('UserModel')->getLoggedUser()[ 'nama' ];?>!</strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li><a class="dropdown-item" href="<?=base_url('auth/logout');?>">Keluar</a></li>
                </ul>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?=base_url('dashboard');?>"
                        class="nav-link <?=url_is('dashboard*') ? 'active' : 'link-body-emphasis';?>"
                        aria-current="page">
                        <i class="fa fa-home me-2"></i>
                        Beranda
                    </a>
                </li>

                <?php if (model('UserModel')->getLoggedUser()[ 'jabatan' ] == 'admin'): ?>
                <li class="nav-item sidebar-heading text-body-secondary text-uppercase px-3 mt-4 mb-1">
                    Data Master
                </li>
                <li>
                    <a href="<?=base_url('admin/users');?>"
                        class="nav-link <?=url_is('admin/users*') ? 'active' : 'link-body-emphasis';?>">
                        <i class="fa fa-users me-2"></i>
                        Kelola User
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('admin/menu');?>"
                        class="nav-link <?=url_is('admin/menu*') ? 'active' : 'link-body-emphasis';?>">
                        <i class="fa fa-bowl-food me-2"></i>
                        Kelola Menu
                    </a>
                </li>
                <?php endif;?>
                <?php if (model('UserModel')->getLoggedUser()[ 'jabatan' ] == 'kasir'): ?>
                <li class="nav-item sidebar-heading text-body-secondary text-uppercase px-3 mt-4 mb-1">
                    Transaksi
                </li>
                <li>
                    <a href="<?=base_url('kasir/transaksi/create');?>"
                        class="nav-link <?=url_is('kasir/transaksi/create/') ? 'active' : 'link-body-emphasis';?>">
                        <i class="fa fa-cash-register me-2"></i>
                        Input Transaksi
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('kasir/transaksi');?>"
                        class="nav-link <?=url_is('kasir/transaksi/') ? 'active' : 'link-body-emphasis';?>">
                        <i class="fa fa-history me-2"></i>
                        Riwayat Transaksi
                    </a>
                </li>
                <li class="nav-item sidebar-heading text-body-secondary text-uppercase px-3 mt-4 mb-1">
                    Laporan
                </li>
                <li>
                    <a href="<?=base_url('kasir/laporan');?>"
                        class="nav-link <?=url_is('kasir/laporan*') ? 'active' : 'link-body-emphasis';?>">
                        <i class="fa fa-file-alt me-2"></i>
                        Laporan Transaksi
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</div>