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
        'deskripsi_video',
        'id_katvideo'
    ];
    
    protected $validationRules = [
        'judul_video' => 'required|max_length[50]',
        'video_url' => 'required|max_length[255]',
        'deskripsi_video' => 'permit_empty',
        'id_katvideo' => 'permit_empty|integer'
    ];
    
    protected $validationMessages = [
        'judul_video' => [
            'required' => 'Judul video wajib diisi.',
            'max_length' => 'Judul video tidak boleh lebih dari 50 karakter.'
        ],
        'video_url' => [
            'required' => 'URL video wajib diisi.',
            'max_length' => 'URL video tidak boleh lebih dari 255 karakter.'
        ],
        'id_katvideo' => [
            'integer' => 'ID kategori video harus berupa angka.'
        ]
    ];
}
