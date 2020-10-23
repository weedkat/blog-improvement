<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'idkomentar';

    protected $returnType     = 'array';

    protected $allowedFields = ['idpost', 'idpenulis', 'isi'];
    protected $useTimestamps = true;
    protected $createdField  = 'tgl_insert';
    protected $updatedField  = 'tgl_update';

    // FUNCTION & METHOD //
    public function getDataKomentar($ids = false)
    {
        if ($ids === false) {
            return $this->findAll();
        }

        return $this->komentarModel->where(['idkomentar' => $ids])->first();
    }

    public function getKomentarByPost($idspost)
    {
        return $this->join('penulis', 'komentar.idpenulis = penulis.idpenulis')
            ->where(['idpost' => $idspost])->find();
    }
}
