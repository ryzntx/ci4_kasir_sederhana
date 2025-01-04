<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'user';
    protected $primaryKey    = 'id_user';
    protected $allowedFields = [ 'nama', 'email', 'password', 'jabatan' ];

    public function getUserById($id)
    {
        return $this->where([ 'id_user' => $id ])->first();
    }

    public function getLoggedUser()
    {
        return $this->where([ 'id_user' => session()->get('user_id') ])->first();
    }
}