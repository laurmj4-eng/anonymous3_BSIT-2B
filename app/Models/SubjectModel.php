<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    
    // 1. ENABLE SOFT DELETES
    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';
    
    // 2. Add 'deleted_at' to the allowed fields (updated for Subject fields)
    protected $allowedFields = ['name', 'code', 'description', 'created_at', 'updated_at', 'deleted_at'];

    public function getRecords($start, $length, $searchValue = '')
    {
        $builder = $this->builder();
        $builder->select('*');

        // 3. Hide deleted subjects from the DataTable view
        $builder->where('deleted_at IS NULL');

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('name', $searchValue)
                ->orLike('code', $searchValue)
                ->orLike('description', $searchValue)
                ->groupEnd();
        }

        $filteredBuilder = clone $builder;
        $filteredRecords = $filteredBuilder->countAllResults(false);

        $builder->limit($length, $start);
        $data = $builder->get()->getResultArray();

        return ['data' => $data, 'filtered' => $filteredRecords];
    }
}