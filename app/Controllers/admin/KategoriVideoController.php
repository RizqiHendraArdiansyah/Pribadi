<?php

namespace App\Controllers\admin;

use App\Models\KategoriVideoModel;
use App\Controllers\BaseController;


class KategoriVideoController extends BaseController
{
    private $KategoriVideoModel;
    
    public function __construct()
    {
        $this->KategoriVideoModel = new KategoriVideoModel();
    }
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

    $KategoriVideos = $this->KategoriVideoModel->findAll();
    $model = new KategoriVideoModel();
    $data['kategori_videos'] = $model->findAll();
    $validation = \Config\Services::validation();

    return view('admin/kategori_videos/index', [
        'all_data_video' => $data,
        'kategori_videos' => $KategoriVideos, // Add this line
        'validation' => $validation
    ]);     
    }

    public function create()
    {// Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        $model = new KategoriVideoModel();
        $data['kategori_videos'] = $model->findAll();
        $validation = \Config\Services::validation();
        return view('admin/kategori_videos/create', [
            'all_data_video' => $data,
            'validation' => $validation
        ]);
    }

    public function store()
    {
        $model = new KategoriVideoModel();
        
        if ($this->request->getMethod() === 'post' && $this->validate([
            'nama_kategori_video' => 'required|max_length[255]',
        ])) {
            $model->save([
                'nama_kategori_video' => $this->request->getPost('nama_kategori_video')
            ]);

            return redirect()->to('index/kategori_videos');
        }

        return view('/kategori_videos/create', [
            'validation' => $this->validator,
        ]);
    }

    public function edit($id)
    {
        $model = new KategoriVideoModel();
        $data['kategori_video'] = $model->find($id);

        if (empty($data['kategori_video'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori Video tidak ditemukan');
        }

        return view('admin/kategori_videos/edit', $data);
    }

    public function update($id)
    {
        $model = new KategoriVideoModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'nama_kategori_video' => 'required|max_length[255]',
        ])) {
            $model->update($id, [
                'nama_kategori_video' => $this->request->getPost('nama_kategori_video')
            ]);

            return redirect()->to('admin/kategori_videos');
        }

        $data['kategori_video'] = $model->find($id);
        $data['validation'] = $this->validator;

        return view('admin/kategori_videos/edit', $data);
    }

    public function delete($id)
    {
        $model = new KategoriVideoModel();
        $model->delete($id);
        
        return redirect()->to('admin/kategori_videos');
    }
}
