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
        'deskripsi_video'
    ];

    protected $validationRules = [
        'judul_video' => 'required|max_length[100]',
        'video_url' => 'required|max_length[255]',
        'thumbnail' => 'permit_empty|max_length[255]',
        'deskripsi_video' => 'permit_empty'
    ];

    protected $validationMessages = [
        'judul_video' => [
            'required' => 'Judul video wajib diisi.',
            'max_length' => 'Judul video tidak boleh lebih dari 100 karakter.'
        ],
        'video_url' => [
            'required' => 'URL video wajib diisi.',
            'max_length' => 'URL video tidak boleh lebih dari 255 karakter.'
        ],
        'thumbnail' => [
            'max_length' => 'URL thumbnail tidak boleh lebih dari 255 karakter.'
        ]
    ];
}
