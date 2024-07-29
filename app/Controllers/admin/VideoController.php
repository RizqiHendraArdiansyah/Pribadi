<?php

namespace App\Controllers\admin;

use App\Models\VideoPembelajaranModel;
use App\Models\KategoriVideoModel;

class VideoController extends BaseController
{
    public function index() {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
            // Ubah 'login' sesuai dengan halaman login Anda
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

    $model = new VideoPembelajaranModel();
        $data['videos'] = $model->findAll();

        return view('admin/videos/index', $data);
    }

    public function create()
    {
        $kategoriModel = new KategoriVideoModel();
        $data['kategori_videos'] = $kategoriModel->findAll();
        return view('admin/videos/create', $data);
    }

    public function store()
    {
        $model = new VideoPembelajaranModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'judul_video' => 'required|max_length[50]',
            'video_url' => 'required|max_length[255]',
        ])) {
            $model->save([
                'judul_video' => $this->request->getPost('judul_video'),
                'video_url' => $this->request->getPost('video_url'),
                'deskripsi_video' => $this->request->getPost('deskripsi_video'),
                'id_katvideo' => $this->request->getPost('id_katvideo'),
            ]);

            return redirect()->to('admin/videos');
        }

        $kategoriModel = new KategoriVideoModel();
        $data['kategori_videos'] = $kategoriModel->findAll();
        return view('admin/videos/create', [
            'validation' => $this->validator,
            'kategori_videos' => $data['kategori_videos'],
        ]);
    }

    public function edit($id)
    {
        $model = new VideoPembelajaranModel();
        $data['video'] = $model->find($id);

        if (empty($data['video'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Video tidak ditemukan');
        }

        $kategoriModel = new KategoriVideoModel();
        $data['kategori_videos'] = $kategoriModel->findAll();
        return view('admin/videos/edit', $data);
    }

    public function update($id)
    {
        $model = new VideoPembelajaranModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'judul_video' => 'required|max_length[50]',
            'video_url' => 'required|max_length[255]',
        ])) {
            $model->update($id, [
                'judul_video' => $this->request->getPost('judul_video'),
                'video_url' => $this->request->getPost('video_url'),
                'deskripsi_video' => $this->request->getPost('deskripsi_video'),
                'id_katvideo' => $this->request->getPost('id_katvideo'),
            ]);

            return redirect()->to('admin/videos');
        }

        $data['video'] = $model->find($id);
        $kategoriModel = new KategoriVideoModel();
        $data['kategori_videos'] = $kategoriModel->findAll();
        $data['validation'] = $this->validator;

        return view('admin/videos/edit', $data);
    }

    public function delete($id)
    {
        $model = new VideoPembelajaranModel();
        $model->delete($id);

        return redirect()->to('admin/videos');
    }
}
