<?php

namespace App\Models;

use CodeIgniter\Model;

class FieldModel extends Model
{
    protected $table          = 'field';
    protected $primaryKey     = 'field_id';
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'field_name',
        'address',
        'subdistrict',
        'district',
        'city',
        'province',
        'price',
        'number_of_fields',
        'owner_id',
        'field_image'
    ];
    protected $useTimestamps      = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
// ini tuh untuk dapetin semua lapangan yang aktiv
    public function getAllField(){
        $query = "SELECT * FROM field WHERE is_active = '1'";
        return $this->db->query($query)->getResultArray();
    }
// dapetin detail field
    public function getDetailField($fieldId){
        $query = "SELECT * FROM field WHERE field_id='$fieldId'";
        return $this->db->query($query)->getRowArray();
    }
// code ini untuk dapetin field yang sudah kebooking berdasarkan waktunya
    public function getFieldBookedTime($fieldId){
        $query = "SELECT field_number, booking_time, booking_date FROM field JOIN booking JOIN detail_booking
                    ON booking.booking_id = detail_booking.booking_id
                    ON field.field_id = booking.field_id
                    WHERE field.field_id='$fieldId'";
        return $this->db->query($query)->getResultArray();
    }
// untuk mendapatkan lapangan sesuai daerah yang di inginkan 
    public function filterField($request) {
        $condition = '';
        if ($request['province']) {
            $condition = $condition. " AND province = '".$request['province']."' ";
            if ($request['city']) {
                $condition = $condition. " AND city ='".$request['city']."' ";
                if ($request['district']) {
                    $condition = $condition. " AND district ='".$request['district']."' ";
                    if ($request['subdistrict']) {
                        $condition = $condition. " AND subdistrict ='".$request['subdistrict']."' ";
                    }
                }
            }
        }

        if ($request['keywords']) {
            $condition = $condition. " AND (address LIKE '%"  .$request['keywords']."%' ";
            $condition = $condition. " OR province LIKE '%"  .$request['keywords']."%' ";
            $condition = $condition. " OR city LIKE '%"  .$request['keywords']."%' ";
            $condition = $condition. " OR district LIKE '%"  .$request['keywords']."%' ";
            $condition = $condition. " OR subdistrict LIKE '%"  .$request['keywords']."%' ";
            $condition = $condition. " OR field_name LIKE '%"  .$request['keywords']."%' )";
        }

        $query = "SELECT * FROM field WHERE is_active = '1'". $condition . ';';
        return $this->db->query($query)->getResultArray();
    }
}
