<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\DPCModels;
use App\Models\DPDModels;
use App\Models\MemberModels;
use App\Models\PengumumanModels;

class Dashboardctrl extends BaseController
{
    private $DPCModels;
    private $DPDModels;
    private $MemberModels;
    private $PengumumanModels;


    public function __construct()
    {
        $this->DPCModels = new DPCModels();
        $this->DPDModels = new DPDModels();
        $this->MemberModels = new MemberModels();
        $this->PengumumanModels = new PengumumanModels();
    }
    
    public function index()
    {
        // Pengecekan apakah pengguna sudah login atau belum
        if (!session()->get('logged_in')) {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('login'));
        }

        // Periksa peran pengguna
        $role = session()->get('role');
        if ($role !== 'admin') {
            // Jika peran bukan admin, arahkan ke halaman lain (misal: user)
            return redirect()->to(base_url('/')); // Sesuaikan dengan URL halaman user
        }
        
        // Mengakses data dari model sesuai kebutuhan
        $data['totalDPC'] = $this->DPCModels->countAll(); // Count all records in DPCModels
        $data['totalDPD'] = $this->DPDModels->countAll(); // Count all records in DPDModels
        $data['totalMember'] = $this->MemberModels->where('role', 'user')->countAllResults(); // Count members with role 'user' in MemberModels
        $data['totalPengumuman'] = $this->PengumumanModels->countAll(); // Count all records in PengumumanModels

  

        return view('admin/dashboard/index', $data);
    }

    public function routetoDashboard()
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

        return redirect()->to(base_url('admin/dashboard'));
    }
}
