<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'idadmin';

    protected $returnType     = 'array';

    protected $allowedFields = ['nama', 'email', 'password'];

    protected $useTimestamps = true;
    protected $createdField  = 'tgl_insert';
    protected $updatedField  = 'tgl_update';

    // FUNCTION & METHOD //
    public function getDataAdmin($ids = false)
    {
        if ($ids === false) {
            return $this->findAll();
        }

        return $this->adminModel->where(['idadmin' => $ids])->first();
    }
}
