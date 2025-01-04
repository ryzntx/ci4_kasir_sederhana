<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailTransaksiModel;
use App\Models\MenuModel;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    protected $transaksiModel, $menuModel, $detailTransaksiModel;

    public function __construct()
    {
        $this->transaksiModel       = new TransaksiModel();
        $this->menuModel            = new MenuModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
    }

    public function new ()
    {
        $menus = $this->menuModel->findAll();

        if (session()->has('cart')) {
            $cart = session()->get('cart');
        } else {
            $cart = [  ];
        }

        return view('pages/kasir/transaksi/index', compact('menus', 'cart'));
    }

    public function storeToCart()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id_menu' => 'required',
            'jumlah'  => 'required|numeric',
         ], [
            'id_menu' => [
                'required' => 'Menu harus dipilih.',
             ],
            'jumlah'  => [
                'required' => 'Jumlah menu harus diisi.',
                'numeric'  => 'Jumlah menu harus berupa angka.',
             ],
         ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kasir/transaksi/create')->withInput()->with('errors', $validation->getErrors());
        }

        $id_menu = $this->request->getPost('id_menu');
        $menu    = $this->menuModel->find($id_menu);

        $id_row = md5($menu[ 'nama_menu' ] . serialize($this->request->getPost('jumlah')));

        $data = [
            $id_row => [
                'id_menu' => $id_menu,
                'menu'    => $menu[ 'nama_menu' ],
                'harga'   => $menu[ 'harga' ],
                'jumlah'  => $this->request->getPost('jumlah'),
                'total'   => $menu[ 'harga' ] * $this->request->getPost('jumlah'),
             ],
         ];

        if (!session()->has('cart')) {
            session()->set('cart', $data);
        } else {
            $exist = 0;
            $cart  = session()->get('cart');

            foreach ($cart as $key => $value) {
                if ($value[ 'id_menu' ] == $id_menu) {
                    $cart[ $key ][ 'jumlah' ] += $this->request->getPost('jumlah');
                    $cart[ $key ][ 'total' ] = $cart[ $key ][ 'harga' ] * $cart[ $key ][ 'jumlah' ];
                    $exist++;
                }
            }

            if (0 == $exist) {
                $cart = array_merge($cart, $data);
                session()->set('cart', $cart);
            } else {
                session()->set('cart', $cart);

            }
        }

        return redirect()->to('/kasir/transaksi/create')->with('toast_success', 'Item berhasil ditambahkan ke keranjang.');
    }

    public function changeQuantityItem($id)
    {
        $cart = session()->get('cart');

        $cart[ $id ][ 'jumlah' ] = $this->request->getPost('jumlah');
        $cart[ $id ][ 'total' ]  = $cart[ $id ][ 'harga' ] * $this->request->getPost('jumlah');

        session()->set('cart', $cart);

        return redirect()->to('/kasir/transaksi/create')->with('toast_success', 'Jumlah item berhasil diubah.');
    }

    public function deleteItemFromCart($id)
    {
        $cart = session()->get('cart');

        unset($cart[ $id ]);

        session()->set('cart', $cart);

        return redirect()->to('/kasir/transaksi/create')->with('toast_success', 'Item berhasil dihapus dari keranjang.');
    }

    public function clearCart()
    {
        session()->remove('cart');

        return redirect()->to('/kasir/transaksi/create')->with('toast_success', 'Keranjang berhasil dikosongkan.');
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'jenis_pembayaran' => 'required',
            'bayar'            => 'required|numeric',
         ], [
            'jenis_pembayaran' => [
                'required' => 'Jenis pembayaran harus dipilih.',
             ],
            'bayar'            => [
                'required' => 'Jumlah uang yang dibayarkan harus diisi.',
                'numeric'  => 'Jumlah uang yang dibayarkan harus berupa angka.',
             ],
         ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/kasir/transaksi/create')->withInput()->with('errors', $validation->getErrors());
        }

        $today           = date('Y-m-d');
        $countToday      = $this->transaksiModel->where('DATE(tanggal)', $today)->countAllResults();
        $transactionCode = date('Ymd') . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

        $total_belanja = 0;
        foreach ($cart as $item) {
            $total_belanja += $item[ 'total' ];
        }

        $data = [
            'kode_transaksi'   => $transactionCode,
            'total_belanja'    => (int) $total_belanja,
            'jenis_pembayaran' => $this->request->getPost('jenis_pembayaran'),
            'tunai'            => (int) $this->request->getPost('bayar'),
            'kembalian'        => (int) $this->request->getPost('bayar') - (int) $total_belanja,
            'tanggal'          => $today,
            'id_user'          => session()->get('user_id'),
         ];

        $this->transaksiModel->save($data);

        $id_transaksi = $this->transaksiModel->insertID();

        foreach ($cart as $item) {
            $dataDetail = [
                'id_transaksi' => $id_transaksi,
                'id_menu'      => $item[ 'id_menu' ],
                'qty'          => $item[ 'jumlah' ],
                'total_harga'  => $item[ 'total' ],
             ];

            $this->detailTransaksiModel->save($dataDetail);
        }

        session()->remove('cart');

        return redirect()->to('/kasir/transaksi/create')->with('toast_success', 'Transaksi berhasil disimpan.')->with('print', $id_transaksi);
    }

    public function index()
    {
        $transaksi = $this->transaksiModel->orderBy('kode_transaksi', 'DESC')->findAll();

        return view('pages/kasir/riwayat_transaksi/index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi       = $this->transaksiModel->find($id);
        $detailTransaksi = $this->detailTransaksiModel->getDetailTransaksi($id);

        if (!$transaksi) {
            return redirect()->to('/kasir/transaksi')->with('toast_error', 'Transaksi tidak ditemukan.');
        }

        return view('pages/kasir/riwayat_transaksi/show', compact('transaksi', 'detailTransaksi'));
    }

    public function print($id)
    {
        $transaksi       = $this->transaksiModel->join('user', 'user.id_user = transaksi.id_user')->find($id);
        $detailTransaksi = $this->detailTransaksiModel->getDetailTransaksi($id);

        if (!$transaksi) {
            return redirect()->to('/kasir/transaksi')->with('toast_error', 'Transaksi tidak ditemukan.');
        }

        return view('pages/kasir/riwayat_transaksi/print', compact('transaksi', 'detailTransaksi'));
    }

}
