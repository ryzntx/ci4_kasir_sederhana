<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailTransaksiModel;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $transaksiModel, $detailTransaksiModel, $menuModel, $userModel;

    public function __construct()
    {
        $this->transaksiModel       = new TransaksiModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
        $this->menuModel            = new MenuModel();
        $this->userModel            = new UserModel();
    }

    public function index()
    {
        $users                     = $this->userModel->where('jabatan', 'kasir')->findAll();
        $menu                      = $this->menuModel->findAll();
        $total_transaksi           = $this->transaksiModel->selectSum('total_belanja')->first()[ 'total_belanja' ];
        $total_transaksi_hari_ini  = $this->transaksiModel->where('tanggal', date('Y-m-d'))->selectSum('total_belanja')->first()[ 'total_belanja' ];
        $total_transaksi_bulan_ini = $this->transaksiModel->where('MONTH(tanggal)', date('m'))->selectSum('total_belanja')->first()[ 'total_belanja' ];

        $transaksi_bulan = $this->transaksiModel->select('MONTH(tanggal) as month, MONTHNAME(tanggal) as month_name, COUNT(*) as total')
            ->groupBy('month')
            ->groupBy('month_name')
            ->get()
            ->getResultArray();

        $transaksi_tahun = $this->transaksiModel->select('YEAR(tanggal) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get()
            ->getResultArray();

        $transaksi_user = $this->transaksiModel->select('transaksi.id_user, COUNT(*) as total')
            ->join('user', 'transaksi.id_user = user.id_user', 'left')
            ->where('user.jabatan', 'kasir')
            ->groupBy('transaksi.id_user')
            ->get()
            ->getResultArray();

        $transaksi_menu = $this->detailTransaksiModel->select('menu.id_menu, menu.nama_menu, SUM(detail_transaksi.qty) as total')
            ->join('menu', 'detail_transaksi.id_menu = menu.id_menu', 'left')
            ->groupBy('menu.id_menu')
            ->groupBy('menu.nama_menu')
            ->orderBy('total', 'DESC')
            ->get()
            ->getResultArray();

        return view('pages/dashboard', compact('total_transaksi', 'total_transaksi_hari_ini', 'total_transaksi_bulan_ini', 'transaksi_bulan', 'transaksi_tahun', 'transaksi_user', 'users', 'menu', 'transaksi_menu'));
    }
}
