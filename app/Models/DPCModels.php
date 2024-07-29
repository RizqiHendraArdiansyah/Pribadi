<?php

namespace App\Models;

use CodeIgniter\Model;

class DPCModels extends Model
{

    protected $table = "tb_dpc";
    protected $primaryKey = "id_dpc";
    protected $returnType = "object";
    protected $allowedFields = ['id_dpc','id_dpd', 'nama_dpc','wilayah_kerja_dpc'];


    public function getDPC()
    {
         return $this->db->table('tb_dpc')->get()->getResultArray();  
    }
    
    public function getDPCAdmin()
    {
         return $this->db->table('tb_dpc')
         ->join('tb_dpd','tb_dpd.id_dpd=tb_dpc.id_dpd')
         ->orderBy('id_dpc', 'desc')
         ->get()->getResultArray();  
    }
}
