<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\VideoPembelajaranModels;

class Video extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        $video_model = new VideoPembelajaranModels();
        $videos = $video_model->findAll();

        return view('admin/video_pembelajaran/index', [
            'videos' => $videos
        ]);
    }

    public function tambah()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        return view('admin/video_pembelajaran/tambah');
    }

    public function proses_tambah()
    {
        $video_model = new VideoPembelajaranModels();
        
        // Handle thumbnail upload
        $thumbnail = $this->request->getFile('thumbnail');
        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/thumbnails/', $thumbnailName);
        } else {
            $thumbnailName = null;
        }

        $data = [
            'judul_video' => $this->request->getVar("judul_video"),
            'video_url' => $this->request->getVar("video_url"),
            'thumbnail' => $thumbnailName,
            'deskripsi_video' => $this->request->getVar("deskripsi_video"),
        ];

        if ($video_model->insert($data)) {
            session()->setFlashdata('success', 'Data berhasil disimpan');
        } else {
            session()->setFlashdata('error', 'Data gagal disimpan');
        }

        return redirect()->to(base_url('admin/video_pembelajaran/index'));
    }

    public function edit($id_video)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        $video_model = new VideoPembelajaranModels();
        $video = $video_model->find($id_video);

        return view('admin/video_pembelajaran/edit', [
            'video' => $video
        ]);
    }

    public function proses_edit($id_video)
    {
        $video_model = new VideoPembelajaranModels();
        
        // Handle thumbnail upload
        $thumbnail = $this->request->getFile('thumbnail');
        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/thumbnails/', $thumbnailName);
        } else {
            $thumbnailName = $this->request->getVar('old_thumbnail');
        }

        $data = [
            'judul_video' => $this->request->getVar("judul_video"),
            'video_url' => $this->request->getVar("video_url"),
            'thumbnail' => $thumbnailName,
            'deskripsi_video' => $this->request->getVar("deskripsi_video"),
        ];

        if ($video_model->update($id_video, $data)) {
            session()->setFlashdata('success', 'Data berhasil diubah');
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
        }

        return redirect()->to(base_url('admin/video_pembelajaran/index'));
    }

    public function delete($id_video)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');
        if ($role !== 'admin') {
            return redirect()->to(base_url('/'));
        }

        $video_model = new VideoPembelajaranModels();
        if ($video_model->delete($id_video)) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
        }

        return redirect()->to(base_url('admin/video_pembelajaran/index'));
    }
}
