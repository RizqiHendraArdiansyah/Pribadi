<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModels extends Model
{

    protected $table = "tb_member";
    protected $primaryKey = "id_member";
    protected $returnType = "object";
    protected $allowedFields = ['id_member','role', 'username','password','nama_member', 'id_dpc','status_kepengurusan','alamat_member','no_hp_member','email_member','ig_member','fb_member','pendidikan_member','pekerjaan_member','sertifikasi_member','jenis_kelamin','foto_member','slug', 'cv_member'];


    public function getMember()
    {
         return $this->db->table('tb_member')->get()->getResultArray();  
    }
    
    public function getProfil()
    {
        if (isset($_SESSION['id_member'])) {
            // Ambil data panduan khusus dari pengguna yang sedang login
            $userData = $this->db->table('tb_member')
                ->where('id_member', $_SESSION['id_member'])
                ->get()
                ->getResultArray();

            return $userData;
        }
    }
    
    public function getMemberAdmin()
    {
         return $this->db->table('tb_member')
         ->join('tb_dpc','tb_dpc.id_dpc=tb_member.id_dpc')
         ->where('role', 'user')
         ->orderBy('id_member', 'desc')
         ->get()->getResultArray();  
    }
    
    public function getMemberUser()
    {
         return $this->db->table('tb_member')
         ->join('tb_dpc','tb_dpc.id_dpc=tb_member.id_dpc')
         ->where('role', 'user')
         ->orderBy('RAND()')
         ->get()->getResultArray();  
    }
    
    public function getDetailMember($id_member, $slug)
    {
         return $this->db->table('tb_member')
         ->join('tb_dpc','tb_dpc.id_dpc=tb_member.id_dpc')
         ->where('tb_member.id_member', $id_member)
         ->where('tb_member.slug', $slug)
         ->get()->getResultArray();  
    }
    
    public function getMemberLainnya($id_member)
    {
        return $this->db->table('tb_member')
            ->join('tb_dpc','tb_dpc.id_dpc=tb_member.id_dpc')
            ->where('id_member !=', $id_member)
            ->where('role', 'user')
            ->orderBy('RAND()')
            ->limit(4)
            ->get()->getResultArray();
    }
    
    public function getMembersByDPD($id_dpd)
    {
        return $this->table('tb_member')
            ->join('tb_dpc', 'tb_dpc.id_dpc=tb_member.id_dpc')
            ->where('tb_dpc.id_dpd', $id_dpd)
            ->where('role', 'user') // Hanya tampilkan member dengan role 'user'
            ->orderBy('RAND()') // Sesuaikan dengan field yang sesuai
            ->get()
            ->getResultArray();
    }

    
    public function searchMember($dpc, $search)
    {
        $query = $this->table('tb_member')
            ->join('tb_dpc', 'tb_dpc.id_dpc=tb_member.id_dpc')
            ->where('role', 'user');
    
        if (!empty($dpc)) {
            $query->like('nama_dpc', $dpc);
        }
    
        if (!empty($search)) {
            $query->groupStart()
                ->like('pekerjaan_member', $search)
                ->orLike('pendidikan_member', $search)
                ->orLike('nama_member', $search)
                ->orLike('status_kepengurusan', $search)
                ->orLike('alamat_member', $search)
                ->orLike('no_hp_member', $search)
                ->orLike('email_member', $search)
                ->orLike('ig_member', $search)
                ->orLike('fb_member', $search)
                ->orLike('sertifikasi_member', $search)
                ->groupEnd();
        }
    
        $query->orderBy('RAND()');
    
        return $query->get()->getResultArray();
    }
}
