<?php

namespace App\Controllers\admin;

use App\Models\MemberModels;
use App\Models\DPCModels;
use App\Models\DPDModels;
use CodeIgniter\Exceptions\PageNotFoundException;

class Member extends BaseController
{

    private $MemberModels;
    private $DPCModels;
    private $DPDModels;


    public function __construct()
    {
        $this->MemberModels = new MemberModels();
        $this->DPCModels = new DPCModels();
        $this->DPDModels = new DPDModels();
    }

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); 
            // Ubah 'login' sesuai dengan halaman login Anda
        }
        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }

        $all_data_member = $this->MemberModels->getMemberAdmin();
        $validation = \Config\Services::validation();
        return view('admin/member/index', [
            'all_data_member' => $all_data_member,
            'validation' => $validation
        ]);
    }

    public function viewMember($id_member, $slug)
	{
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); 
            // Ubah 'login' sesuai dengan halaman login Anda
        }
        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }
        $detail_member = $this->MemberModels->getDetailMember($id_member, $slug);
        
        $data = [
            'member' => $detail_member[0],
            'member_lain' => $this->MemberModels->getMemberLainnya($id_member, 4),
            'DPC' => $this->DPCModels->getDPC(),
            'dpd' => $this->DPDModels->findAll()
        ];

        // tampilkan 404 error jika data tidak ditemukan
		if (!$data['member']) {
			throw PageNotFoundException::forPageNotFound();
		}
        // var_dump($data);
        

		return view('user/member/detail', $data);
	}

    public function tambah()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); 
            // Ubah 'login' sesuai dengan halaman login Anda
        }
        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }
        $all_data_member = $this->MemberModels->findAll();
        $all_data_DPC = $this->DPCModels->findAll();
        $all_data_DPD = $this->DPDModels->findAll();
        $validation = \Config\Services::validation();
        return view('admin/member/tambah', [
            'all_data_member' => $all_data_member,
            'all_data_DPC' => $all_data_DPC,
            'all_data_DPD' => $all_data_DPD,
            'validation' => $validation
        ]);
    }

    public function proses_tambah()
    {
        $username = $this->request->getPost("username");
    
        // Cek apakah username sudah ada
        if ($this->MemberModels->where('username', $username)->countAllResults() > 0) {
            session()->setFlashdata('error_username', 'Username sudah digunakan. Silakan pilih username lain.');
            return redirect()->back()->withInput();
        }
    
        // Validasi file dan data lainnya
        if (!$this->validate([
            'foto_member' => [
                'rules' => 'uploaded[foto_member]|is_image[foto_member]|mime_in[foto_member,image/jpg,image/jpeg,image/png]|max_dims[foto_member,572,572]',
                'errors' => [
                    'uploaded' => 'Pilih foto terlebih dahulu',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png',
                    'max_dims' => 'Ukuran foto tidak boleh melebihi 572x572 piksel'
                ]
            ],

    
            // 'cv_member' => [
            //     'rules' => 'uploaded[cv_member]|is_image[cv_member]|mime_in[cv_member,image/jpg,image/jpeg,image/png]',
            //     'errors' => [
            //         'uploaded' => 'Pilih foto terlebih dahulu',
            //         'is_image' => 'File yang anda pilih bukan gambar',
            //         'mime_in' => 'File yang anda pilih wajib berekstensikan jpg/jpeg/png'
            //     ]
            // ],
    
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi',
                ]
            ],
    
        ])) {
            // Jika validasi gagal, kembalikan dengan pesan kesalahan
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            // Proses upload file dan data lainnya
            $file_foto = $this->request->getFile('foto_member');
            $file_foto->move('assets-baru/img/');
            $file_name = $file_foto->getName();
    
            $file_foto2 = $this->request->getFile('cv_member');
            $file_foto2->move('assets-baru/img/');
            $file_name2 = $file_foto2->getName();
    
            $data = [
                'username' => $username,
                'password' => $this->request->getPost("password"),
                'nama_member' => $this->request->getPost("nama_member"),
                'id_dpc' => $this->request->getPost("id_dpc"),
                'status_kepengurusan' => $this->request->getPost("status_kepengurusan"),
                'alamat_member' => $this->request->getPost("alamat_member"),
                'no_hp_member' => $this->request->getPost("no_hp_member"),
                'email_member' => $this->request->getPost("email_member"),
                'ig_member' => $this->request->getPost("ig_member"),
                'fb_member' => $this->request->getPost("fb_member"),
                'pendidikan_member' => $this->request->getPost("pendidikan_member"),
                'pekerjaan_member' => $this->request->getPost("pekerjaan_member"),
                'sertifikasi_member' => $this->request->getPost("sertifikasi_member"),
                'jenis_kelamin' => $this->request->getPost("jenis_kelamin"),
                'foto_member' => $file_name,
                'cv_member' => $file_name2,
                'slug' => url_title($this->request->getPost('nama_member'), '-', TRUE)
            ];
    
            $this->MemberModels->insert($data);
    
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to(base_url('admin/member/index'));
        }
    }


    public function edit($id_member)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); 
            // Ubah 'login' sesuai dengan halaman login Anda
        }
        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }        
        $memberData = $this->MemberModels->find($id_member);
        $dpcData = $this->DPCModels->findAll();

        $validation = \Config\Services::validation();

        return view('admin/member/edit', [
            'memberData' => $memberData,
            'dpcData' => $dpcData,
            'validation' => $validation
        ]);
    }

    // Artikel.php (Controller)
   public function proses_edit($id_member = null)
    {
        if (!$id_member) {
            return redirect()->back();
        }
    
        $dataMember = $this->MemberModels->find($id_member);
        
        $newUsername = $this->request->getPost("username");

        // Cek apakah username yang baru diinginkan sudah digunakan oleh member lain
        if ($newUsername !== $dataMember->username && $this->MemberModels->where('username', $newUsername)->countAllResults() > 0) {
            session()->setFlashdata('error_username', 'Username sudah digunakan. Silakan pilih username lain.');
            return redirect()->back()->withInput();
        }
    
        // Cek apakah file 'foto_member' yang baru diunggah
        if ($this->request->getFile('foto_member')->isValid()) {
            // Hapus file 'foto_member' yang lama
            unlink('assets-baru/img/' . $dataMember->foto_member);
    
            // Unggah file 'foto_member' yang baru
            $fileFoto = $this->request->getFile('foto_member');
            $namaFoto = $fileFoto->getName();
            $fileFoto->move('assets-baru/img/', $namaFoto);
    
        } else {
            // Jika tidak ada file 'foto_member' yang baru diunggah, gunakan nama file yang sudah ada
            $namaFoto = $dataMember->foto_member;
        }
    
        // Cek apakah file 'cv_member' yang baru diunggah
        if ($this->request->getFile('cv_member')->isValid()) {
            // Hapus file 'cv_member' yang lama
            unlink('assets-baru/img/' . $dataMember->cv_member);
    
            // Unggah file 'cv_member' yang baru
            $fileCV = $this->request->getFile('cv_member');
            $namaCV = $fileCV->getName();
            $fileCV->move('assets-baru/img/', $namaCV);
    
        } else {
            // Jika tidak ada file 'cv_member' yang baru diunggah, gunakan nama file yang sudah ada
            $namaCV = $dataMember->cv_member;
        }
    
        // Perbarui kolom-kolom dalam database dengan klausa "where"
        $this->MemberModels->where('id_member', $id_member)->set([
            'foto_member' => $namaFoto,
            'cv_member' => $namaCV,
            'username' => $newUsername,
            'password' => $this->request->getPost("password"),
            'nama_member' => $this->request->getPost("nama_member"),
            'id_dpc' => $this->request->getPost("id_dpc"),
            'status_kepengurusan' => $this->request->getPost("status_kepengurusan"),
            'alamat_member' => $this->request->getPost("alamat_member"),
            'no_hp_member' => $this->request->getPost("no_hp_member"),
            'email_member' => $this->request->getPost("email_member"),
            'ig_member' => $this->request->getPost("ig_member"),
            'fb_member' => $this->request->getPost("fb_member"),
            'pendidikan_member' => $this->request->getPost("pendidikan_member"),
            'pekerjaan_member' => $this->request->getPost("pekerjaan_member"),
            'sertifikasi_member' => $this->request->getPost("sertifikasi_member"),
            'jenis_kelamin' => $this->request->getPost("jenis_kelamin"),
            'slug' => url_title($this->request->getPost('nama_member'), '-', TRUE)
        ])->update();
    
        session()->setFlashdata('success', 'Data berhasil diperbarui');
        return redirect()->to(base_url('admin/member/index'));
    }

    public function delete($id = false)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login')); 
            // Ubah 'login' sesuai dengan halaman login Anda
        }
        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }
        $memberModel = new MemberModels();

        $data = $memberModel->find($id);

        unlink('assets-baru/img/' . $data->foto_member);

        $memberModel->delete($id);

        return redirect()->to(base_url('admin/member/index'));
    }
}
