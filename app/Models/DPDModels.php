<?php

namespace App\Models;

use CodeIgniter\Model;

class DPDModels extends Model
{

    protected $table = "tb_dpd";
    protected $primaryKey = "id_dpd";
    protected $returnType = "object";
    protected $allowedFields = ['id_dpd', 'nama_dpd'];


    public function getDPD()
    {
         return $this->db->table('tb_dpd')->get()->getResultArray();  
    }
}
