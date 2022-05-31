<?php

namespace App\Models;

use CodeIgniter\Model;

class OwnerRequestModel extends Model
{
    protected $table          = 'owner_request';
    protected $primaryKey     = 'owner_request_id';
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'user_id',
        'message',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps      = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAllOwnerRequest() {
        $query = "SELECT * FROM owner_request JOIN user
                    ON user.user_id = owner_request.user_id
LEFT JOIN team
ON user.team_id = team.team_id
ORDER BY status ASC";
        return $this->db->query($query)->getResultArray();
    }

}
