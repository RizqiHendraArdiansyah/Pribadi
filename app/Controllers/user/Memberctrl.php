<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\MemberModels;
use App\Models\DPDModels;
use App\Models\DPCModels;

class Memberctrl extends BaseController
{
    private $MemberModels;

    public function __construct()
    {
        $this->MemberModels = new MemberModels();
        $this->DPDModels = new DPDModels();
        $this->DPCModels = new DPCModels();
    }

    // protected $filters = ['usersAuth'];

    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $today = date('Y-m-d');

        $data = [
            'member' => $this->MemberModels->getMemberUser(),
            'dpd' => $this->DPDModels->findAll(),
            'dpc' => $this->DPCModels->findAll()
        ];

        // print_r($data);
        // die;

        return view('user/member/index', $data);
    }
    
    public function indexdpd($id_dpd)
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $today = date('Y-m-d');

        $data = [
            'member' => $this->MemberModels->getMembersByDPD($id_dpd),
            'dpd' => $this->DPDModels->findAll(),
            'dpc' => $this->DPCModels->where('id_dpd', $id_dpd)->get()->getResult()
        ];

        // print_r($data['dpc']);
        // die;

        return view('user/member/index', $data);
    }
    
    public function viewMember($id_member, $slug)
	{
                // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
                return redirect()->to(base_url('login')); 
                // Ubah 'login' sesuai dengan halaman login Anda
        }
        $detail_member = $this->MemberModels->getDetailMember($id_member, $slug);

        // Tambah jumlah views
        // $this->MemberModels->incrementViews($id_member);
        
        $data = [
            'member' => $detail_member[0],
            'member_lain' => $this->MemberModels->getMemberLainnya($id_member, 4),
            'dpd' => $this->DPDModels->findAll()
        ];

        // tampilkan 404 error jika data tidak ditemukan
		if (!$data['member']) {
			throw PageNotFoundException::forPageNotFound();
		}
        // var_dump($data);
        

		return view('user/member/detail', $data);
	}
	
	public function search()
    {
        $dpc = $this->request->getGet('dpc');
        $search = $this->request->getGet('search');
    
        // Lakukan pencarian ke database dengan menggunakan model
        $data = [
            'member' => $this->MemberModels->searchMember($dpc, $search),
            'dpd' => $this->DPDModels->findAll(),
            'dpc' => $this->DPCModels->findAll()
        ];
    
        // Kirim data hasil pencarian ke tampilan yang sesuai (misalnya, halaman home)
        return view('user/member/index', $data);
    }

    public function redirectToHome()
    {
        return redirect()->to('/');
    }
}
