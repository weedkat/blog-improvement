<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table      = "post";
    protected $primaryKey = "idpost";

    protected $returnType     = "array";

    protected $allowedFields = ["idkategori", "idpenulis", "judul", "slug", "isi_post", "file_gambar"];

    protected $useTimestamps = true;
    protected $createdField  = "tgl_insert";
    protected $updatedField  = "tgl_update";

    // FUNCTION & METHOD //
    public function getDataPost($ids = false)
    {
        if ($ids === false) {
            return $this->join("penulis", "post.idpenulis = penulis.idpenulis")
                ->join("kategori", "post.idkategori = kategori.idkategori")
                ->findAll();
        }

        return $this->postModel->where(["idpost" => $ids])->first();
    }

    public function getDataPostBySlug($slug)
    {
        return $this->join("penulis", "post.idpenulis = penulis.idpenulis")
            ->join("kategori", "post.idkategori = kategori.idkategori")
            ->where(["slug" => $slug])
            ->first();
    }

    public function getDataPostByPenulis($idspenulis)
    {
        return $this->postModel->where(["idpost" => $idspenulis])->first();
    }

    public function getOnePostByPenulis($idspost, $idspenulis)
    {
        return $this->postModel->where(["idpenulis" => $idspenulis, "idpost" => $idspost]);
    }

    public function postTerbaru($limit = null)
    {
        if ($limit === false) {
            return $this->join("penulis", "post.idpenulis = penulis.idpenulis")
                ->join("kategori", "post.idkategori = kategori.idkategori")
                ->orderBy("post.tgl_insert", "DESC")
                ->find();
        }
        return $this->join("penulis", "post.idpenulis = penulis.idpenulis")
            ->join("kategori", "post.idkategori = kategori.idkategori")
            ->limit($limit)
            ->orderBy("post.tgl_insert", "DESC")
            ->find();
        }
    }

    public function pencarianPost($keyword)
    {
        return $this->join("penulis", "post.idpenulis = penulis.idpenulis")
            ->join("kategori", "post.idkategori = kategori.idkategori")
            ->like("isi_post", $keyword)
            ->orLike("judul", $keyword);
    }

    public function groupPost($ids)
    {
        return $this->join("kategori", "post.idkategori = kategori.idkategori")
            ->where(["kategori.idkategori" => $ids])
            ->orderBy("post.tgl_insert", "DESC");
    }

    // public function prevPost($ids)
    // {
    //     // return $this->db->query("SELECT * FROM divisi WHERE id_divisi = (SELECT max(id_divisi) FROM divisi WHERE id_divisi < $ids)");
    //     // return $this->where(["idpost" => $this->selectMax("idpost")->where("idpost" < $ids)])->find();
    // }

    // public function nextPost($ids)
    // {
    //     // return $this->db->query("SELECT * FROM divisi WHERE id_divisi = (SELECT max(id_divisi) FROM divisi WHERE id_divisi < $ids)");
    //     // return $this->where("idpost", $this->selectMax("idpost")->where("idpost" > $ids))->find();
    // }
}
