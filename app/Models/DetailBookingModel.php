<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailBookingModel extends Model
{
    protected $table          = 'detail_booking';
    protected $primaryKey     = 'detail_booking_id';
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'booking_id',
        'field_number',
        'booking_time',
        'booking_date'
    ];
    protected $useTimestamps      = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}
