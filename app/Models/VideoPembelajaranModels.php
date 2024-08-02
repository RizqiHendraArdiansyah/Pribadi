<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoPembelajaranModels extends Model
{
    protected $table = 'tb_video';
    protected $primaryKey = 'id_video';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'judul_video',
        'video_url',
        'thumbnail',
        'deskripsi_video',
        'id_katvideo'
    ];

    public function getAllVideosWithCategory()
    {
        return $this->select('tb_video.*, tb_kategori_video.nama_kategori_video')
                    ->join('tb_kategori_video', 'tb_kategori_video.id_katvideo = tb_video.id_katvideo', 'left')
                    ->findAll();
    }
}
