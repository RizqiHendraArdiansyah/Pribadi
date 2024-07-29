<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriVideoModel extends Model
{
    protected $table = 'tb_kategori_video';
    protected $primaryKey = 'id_katvideo';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nama_kategori_video'
    ];

    protected $validationRules = [
        'nama_kategori_video' => 'required|max_length[255]'
    ];

    protected $validationMessages = [
        'nama_kategori_video' => [
            'required' => 'Nama kategori video wajib diisi.',
            'max_length' => 'Nama kategori video tidak boleh lebih dari 255 karakter.'
        ]
    ];
}