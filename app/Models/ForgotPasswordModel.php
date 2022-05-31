<?php

namespace App\Models;

use CodeIgniter\Model;

class ForgotPasswordModel extends Model
{
    protected $table          = 'forgot_password';
    protected $primaryKey     = 'request_id';
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'user_id',
        'created_at',
        'updated_at',
        'link',
        'is_valid',
    ];
    protected $useTimestamps      = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getRequest($link) {
        $query = "SELECT * FROM forgot_password WHERE link='$link'";
        return $this->db->query($query)->getRowArray();
    }

    public function expire($requestId) {
        $query = "UPDATE forgot_password SET is_valid ='0' WHERE request_id='$requestId'";
        $this->db->query($query);
    }
}
