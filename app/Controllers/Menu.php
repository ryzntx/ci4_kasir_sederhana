<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Menu extends ResourceController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new \App\Models\MenuModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $menus = $this->menuModel->findAll();
        return view('pages/admin/menu/index', compact('menus'));
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
        $menu = $this->menuModel->find($id);
        if (!$menu) {
            return redirect()->to('/admin/menu')->with('toast_error', 'Data tidak ditemukan');
        }
        return view('pages/admin/menu/show', compact('menu'));
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new ()
    {
        return view('pages/admin/menu/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_menu'  => 'required',
            'harga'      => 'required|numeric',
            'jenis_menu' => 'required',
         ], [
            'nama_menu'  => [
                'required' => 'Nama menu wajib diisi',
             ],
            'harga'      => [
                'required' => 'Harga wajib diisi',
                'numeric'  => 'Harga harus berupa angka',
             ],
            'jenis_menu' => [
                'required' => 'Jenis menu wajib diisi',
             ],
         ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/admin/menu/create')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_menu'  => $this->request->getPost('nama_menu'),
            'harga'      => $this->request->getPost('harga'),
            'jenis_menu' => $this->request->getPost('jenis_menu'),
         ];

        $foto_menu = $this->request->getFile('foto_menu');
        if ($foto_menu->isValid() && !$foto_menu->hasMoved()) {
            $validated = $this->validate([
                'foto_menu' => [
                    'uploaded[foto_menu]',
                    'mime_in[foto_menu,image/jpg,image/jpeg,image/png]',
                    'max_size[foto_menu,1024]',
                 ],
             ], [
                'foto_menu' => [
                    'uploaded' => 'Pilih foto menu terlebih dahulu',
                    'mime_in'  => 'Format foto tidak valid. Harus jpg/jpeg/png',
                    'max_size' => 'Ukuran foto terlalu besar. Maksimal 1MB',
                 ],
             ]);

            if (!$validated) {
                return redirect()->to('/admin/menu/create')->withInput()->with('errors', $this->validator->getErrors());
            }

            $newName = $foto_menu->getRandomName();
            $path    = 'uploads/menu/' . $newName;
            $foto_menu->move('uploads/menu', $newName);
            $data[ 'foto_menu' ] = $path;
        }

        $this->menuModel->insert($data);

        return redirect()->to('/admin/menu')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
        $menu = $this->menuModel->find($id);
        if (!$menu) {
            return redirect()->to('/admin/menu')->with('toast_error', 'Data tidak ditemukan');
        }
        return view('pages/admin/menu/edit', compact('menu'));
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
        $find = $this->menuModel->find($id);
        if (!$find) {
            return redirect()->to('/admin/menu')->with('toast_error', 'Data tidak ditemukan');
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_menu'  => 'required',
            'harga'      => 'required|numeric',
            'jenis_menu' => 'required',
         ], [
            'nama_menu'  => [
                'required' => 'Nama menu wajib diisi',
             ],
            'harga'      => [
                'required' => 'Harga wajib diisi',
                'numeric'  => 'Harga harus berupa angka',
             ],
            'jenis_menu' => [
                'required' => 'Jenis menu wajib diisi',
             ],
         ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/admin/menu/edit/' . $id)->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_menu'  => $this->request->getPost('nama_menu'),
            'harga'      => $this->request->getPost('harga'),
            'jenis_menu' => $this->request->getPost('jenis_menu'),
         ];

        $foto_menu = $this->request->getFile('foto_menu');

        if ($foto_menu->isValid() && !$foto_menu->hasMoved()) {
            $validated = $this->validate([
                'foto_menu' => [
                    'uploaded[foto_menu]',
                    'mime_in[foto_menu,image/jpg,image/jpeg,image/png]',
                    'max_size[foto_menu,1024]',
                 ],
             ], [
                'foto_menu' => [
                    'uploaded' => 'Pilih foto menu terlebih dahulu',
                    'mime_in'  => 'Format foto tidak valid. Harus jpg/jpeg/png',
                    'max_size' => 'Ukuran foto terlalu besar. Maksimal 1MB',
                 ],
             ]);

            if (!$validated) {
                return redirect()->to('/admin/menu/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
            }

            // Hapus foto lama
            if ($find[ 'foto_menu' ] && file_exists($find[ 'foto_menu' ])) {
                unlink($find[ 'foto_menu' ]);
            }

            $newName = $foto_menu->getRandomName();
            $path    = 'uploads/menu/' . $newName;
            $foto_menu->move('uploads/menu', $newName);
            $data[ 'foto_menu' ] = $path;
        }

        $this->menuModel->update($id, $data);

        return redirect()->to('/admin/menu')->with('success', 'Data berhasil diubah');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $find = $this->menuModel->find($id);
        if (!$find) {
            return redirect()->to('/admin/menu')->with('toast_error', 'Data tidak ditemukan');
        }

        if ($find[ 'foto_menu' ] && file_exists($find[ 'foto_menu' ])) {
            unlink($find[ 'foto_menu' ]);
        }

        $this->menuModel->delete($id);

        return redirect()->to('/admin/menu')->with('success', 'Data berhasil dihapus');
    }
}