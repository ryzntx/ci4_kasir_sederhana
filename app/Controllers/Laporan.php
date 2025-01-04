<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailTransaksiModel;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Laporan extends BaseController
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
        $transaksis = $this->transaksiModel;
        $users      = $this->userModel->findAll();

        if (request()->getGet('tanggal')) {
            $date       = explode(' - ', request()->getGet('tanggal'));
            $transaksis = $this->transaksiModel->where('tanggal >=', $date[ 0 ])->where('tanggal <=', $date[ 1 ]);
        }

        if (request()->getGet('bulan')) {
            $transaksis = $transaksis->where('MONTH(tanggal)', request()->getGet('bulan'));
        }

        if (request()->getGet('tahun')) {
            $transaksis = $transaksis->where('YEAR(tanggal)', request()->getGet('tahun'));
        }

        if (request()->getGet('jenis_pembayaran')) {
            $transaksis = $transaksis->where('jenis_pembayaran', request()->getGet('jenis_pembayaran'));
        }

        if (request()->getGet('user')) {
            $transaksis = $transaksis->where('id_user', request()->getGet('user'));
        }

        $transaksis = $transaksis->orderBy('kode_transaksi', 'DESC')->findAll();

        $total_transaksi           = $this->transaksiModel->selectSum('total_belanja')->first()[ 'total_belanja' ];
        $total_transaksi_hari_ini  = $this->transaksiModel->where('tanggal', date('Y-m-d'))->selectSum('total_belanja')->first()[ 'total_belanja' ];
        $total_transaksi_bulan_ini = $this->transaksiModel->where('MONTH(tanggal)', date('m'))->selectSum('total_belanja')->first()[ 'total_belanja' ];

        // dd($total_transaksi, $total_transaksi_hari_ini, $total_transaksi_bulan_ini);

        return view('pages/kasir/laporan/index', compact('transaksis', 'users', 'total_transaksi', 'total_transaksi_hari_ini', 'total_transaksi_bulan_ini'));
    }
}
