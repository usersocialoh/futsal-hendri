<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table          = 'user';
    protected $primaryKey     = 'user_id';
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'email',
        'password',
        'name',
        'phone_number',
        'role_id',
        'team_id',
        'updated_at',
        'image',
    ];
    protected $useTimestamps      = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
// code for use profile
    public function getUserById($user_id) {
        $query = "SELECT * FROM user JOIN role
                    ON user.role_id = role.role_id 
                    LEFT JOIN team
                    ON user.team_id = team.team_id WHERE user_id='$user_id'";
        return $this->db->query($query)->getRowArray();
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM user WHERE email='$email'";
        return $this->db->query($query)->getRowArray();
    }
// code ini untuk menampilkan member
    public function getAllMember() {
        $query = "SELECT * FROM user LEFT JOIN team
                    ON user.team_id = team.team_id  WHERE role_id='1'";
        return $this->db->query($query)->getResultArray();
    }
// code ini untuk menampilkan owner
    public function getAllOwner() {
        $query = "SELECT * FROM user LEFT JOIN team
                    ON user.team_id = team.team_id  WHERE role_id='2'";
        return $this->db->query($query)->getResultArray();
    }
// code ini untuk menampilkan admin
    public function getAllAdmin() {
        $query = "SELECT * FROM user LEFT JOIN team
                    ON user.team_id = team.team_id  WHERE role_id='3'";
        return $this->db->query($query)->getResultArray();
    }
// button action set as member
    public function setAsMember($userId) {
        $query = "UPDATE user SET role_id='1' WHERE user_id='$userId'";
        return $this->db->query($query);
    }

    public function setAsOwner($userId) {
        $query = "UPDATE user SET role_id='2' WHERE user_id='$userId'";
        return $this->db->query($query);
    }

    public function setAsAdmin($userId) {
        $query = "UPDATE user SET role_id='3' WHERE user_id='$userId'";
        return $this->db->query($query);
    }

    public function changePassword($userId, $password) {
        $query = "UPDATE user SET password ='$password' WHERE user_id='$userId'";
        return $this->db->query($query);
    }

    public function approveOwner($ownerRequestId) {
        $query = "UPDATE owner_request SET status='1' WHERE owner_request_id = '$ownerRequestId'";
        $this->db->query($query);
        $query = "SELECT * FROM owner_request WHERE owner_request_id = '$ownerRequestId'";
        $userId = $this->db->query($query)->getRowArray()['user_id'];
        $query = "UPDATE user SET role_id='2' WHERE user_id='$userId'";
        $this->db->query($query);
        $fieldModel = new FieldModel();
        $fieldModel->save(["owner_id"=>$userId]);
    }
}
