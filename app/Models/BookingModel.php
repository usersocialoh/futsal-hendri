<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table          = 'booking';
    protected $primaryKey     = 'booking_id';
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'user_id',
        'field_id',
        'total_price',
        'receipt_image',
        'is_confirmed'
    ];
    protected $useTimestamps      = true;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAllUnconfirmed(){
        $query = "SELECT * FROM booking WHERE is_confirmed='0'";
        return $this->db->query($query)->getResultArray();
    }

    public function getHistory($userId) {
        $query = "SELECT * FROM booking JOIN field ON booking.field_id = field.field_id WHERE user_id='$userId'";
        return $this->db->query($query)->getResultArray();
    }

    public function getDetailBooking($bookingId) {
        $query = "SELECT * FROM booking JOIN field ON booking.field_id = field.field_id 
JOIN detail_booking ON booking.booking_id = detail_booking.booking_id
WHERE booking.booking_id ='$bookingId'";
        return $this->db->query($query)->getResultArray();
    }

    public function getFieldFromBookingId($bookingId) {
        $query = "SELECT * FROM booking WHERE booking_id='$bookingId'";
        $field_id = $this->db->query($query)->getRowArray()['field_id'];
        $query = "SELECT * FROM field WHERE field_id = '$field_id'";
        return $this->db->query($query)->getRowArray();
    }

    public function getBooking($bookingId) {
        $query = "SELECT * FROM booking WHERE booking_id='$bookingId'";
        return $this->db->query($query)->getRowArray();
    }
// return data yang ada bookingan dari owner nya
    public function getOwnerBooking($ownerId) {
        $query = "SELECT * FROM booking JOIN user
ON booking.user_id = user.user_id
JOIN field
ON booking.field_id = field.field_id
WHERE field.owner_id='$ownerId'
";
        return $this->db->query($query)->getResultArray();
    }
// nampilin data user yang booking nya
    public function getOwnerBookingApproval($ownerId) {
        $query = "SELECT * FROM booking JOIN user
ON booking.user_id = user.user_id
JOIN field
ON booking.field_id = field.field_id
WHERE field.owner_id='$ownerId'
AND booking.is_confirmed = 0
";
        return $this->db->query($query)->getResultArray();
    }

    public function book($result, $field_id, $user_id) {
        $bookingModel = new BookingModel();
        $fieldModel = new FieldModel();
        $detailBookingModel = new DetailBookingModel();
        $field = $fieldModel->getDetailField($field_id);
        $data = [
            'user_id' => $user_id,
            'field_id' => $field_id,
            'total_price' => count($result) * $field['price'],
            'is_confirmed' => 0
        ];
        $bookingModel->save($data);
        $bookingId = $bookingModel->getInsertID();
        foreach($result as $r) {
            $temp = explode('__',$r);
            $data = [
                "booking_id" => $bookingId,
                "booking_date" => $temp['0'],
                "booking_time" => $temp['1'],
                "field_number" => $temp['2']
            ];
            $detailBookingModel->save($data);
        }
    }
// button buat approve nya
    public function approve($bookingId) {
        $query = "UPDATE booking SET is_confirmed='1' WHERE booking_id='$bookingId'";
        $this->db->query($query);
    }
}
