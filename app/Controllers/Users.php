<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $users = $this->userModel->findAll();
        return view('pages/admin/user/index', compact('users'));
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
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('toast_error', 'Data tidak ditemukan');
        }
        return view('pages/admin/user/show', compact('user'));
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new ()
    {
        return view('pages/admin/user/create');
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
            'nama'     => 'required',
            'email'    => 'required|valid_email|is_unique[user.email]',
            'jabatan'  => 'required',
            'password' => 'required',
         ], [
            'email'    => [
                'required'    => 'Email harus diisi.',
                'is_unique'   => 'Email sudah digunakan oleh pengguna lain.',
                'valid_email' => 'Email tidak valid.',
             ],
            'nama'     => [
                'required' => 'Nama harus diisi.',
             ],
            'jabatan'  => [
                'required' => 'Jabatan harus diisi.',
             ],
            'password' => [
                'required' => 'Password harus diisi.',
             ],
         ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/admin/users/create')->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'jabatan'  => $this->request->getPost('jabatan'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
         ];

        $this->userModel->insert($data);

        return redirect()->to('/admin/users')->with('success', 'Data berhasil ditambahkan');
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
        $user = $this->userModel->find($id);
        return view('pages/admin/user/edit', compact('user'));
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
        $find = $this->userModel->find($id);
        if (!$find) {
            return redirect()->to('/admin/users')->with('toast_error', 'Data tidak ditemukan');
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama'    => 'required',
            'email'   => 'required|valid_email|is_unique[user.email,id_user,' . $id . ']',
            'jabatan' => 'required',
         ], [
            'email'   => [
                'required'    => 'Email harus diisi.',
                'is_unique'   => 'Email sudah digunakan oleh pengguna lain.',
                'valid_email' => 'Email tidak valid.',
             ],
            'nama'    => [
                'required' => 'Nama harus diisi.',
             ],
            'jabatan' => [
                'required' => 'Jabatan harus diisi.',
             ],
         ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/admin/users/edit/' . $id)->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama'    => $this->request->getPost('nama'),
            'email'   => $this->request->getPost('email'),
            'jabatan' => $this->request->getPost('jabatan'),
         ];

        if ($this->request->getPost('password')) {
            $data[ 'password' ] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/admin/users')->with('success', 'Data berhasil diubah');
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
        $find = $this->userModel->find($id);
        if (!$find) {
            return redirect()->to('/admin/users')->with('toast_error', 'Data tidak ditemukan');
        }
        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'Data berhasil dihapus');
    }
}