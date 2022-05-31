<?php

namespace App\Controllers;

class Owner extends BaseController{


    public function index(){
        return view('welcome_message');
    }

    public function bookingApproval(){
        $booking = $this->bookingModel->getOwnerBookingApproval($this->user['user_id']);
        $data = [
            "title" => "Booking Approval",
            "isSidebarHidden" => false,
            "user" => $this->user,
            "booking" => $booking
        ];
        return view('owner/booking-approval', $data);
    }
// code untuk manage field
    public function manageField(){
        $field = $this->fieldModel->where(["owner_id"=>$this->user['user_id']])->first();
        $data = [
            "title" => "Manage Field",
            "isSidebarHidden" => false,
            "user" => $this->user,
            "field" => $field,
            "validation" => \Config\Services::validation()
        ];
        return view('owner/manage-field', $data);
    }

    public function bookingHistory(){
        $booking = $this->bookingModel->getOwnerBooking($this->user['user_id']);
        $data = [
            "title" => "Booking history",
            "isSidebarHidden" => false,
            "user" => $this->user,
            "booking" => $booking
        ];
        return view('owner/booking-history', $data);
    }

    public function attemptManageField(){
        $image = $this->request->getFile('field_image');
        $validator = [
            'field_id'  => [
                'label' => 'field id',
                'rules' => 'required'
            ],
            'field_name' => [
                'label' => 'field name',
                'rules' => 'required'
            ],
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'subdistrict' => [
                'label' => 'sub district',
                'rules' => 'required'
            ],
            'price' => 'required',
            'address' => 'required',
            'number_of_fields' => [
                'label' => 'number of fields',
                'rules' => 'required'
            ]
        ];
        $hasImage = $this->request->getVar('has_image');
        if ($hasImage) {
            if ($image->getSize() > 0) {
                $validator['field_image'] = [
                    'label' => 'field image',
                    'rules' => 'max_size[field_image,10240]|is_image[field_image]
                |mime_in[field_image,image/jpg,image/jpeg,image/png]'
                ];
            }
        } else {
            $validator['field_image'] = [
                'label' => 'field image',
                'rules' => 'max_size[field_image,10240]|is_image[field_image]
                |mime_in[field_image,image/jpg,image/jpeg,image/png]|uploaded[field_image]'
            ];
        }
        if (!$this->validate($validator)) {
            return redirect()->to('/manage-field')->withInput();
        }
        $data = [
            'field_id'  => $this->request->getVar('field_id'),
            'field_name' => $this->request->getVar('field_name'),
            'province' => $this->request->getVar('province'),
            'city' => $this->request->getVar('city'),
            'district' => $this->request->getVar('district'),
            'subdistrict' => $this->request->getVar('subdistrict'),
            'address' => $this->request->getVar('address'),
            'price' => $this->request->getVar('price'),
            'number_of_fields' => $this->request->getVar('number_of_fields'),
            'is_active' => 1
        ];
        if ($image->getSize() > 0) {
            $image->move('assets/img/field');
            $imageName = $image->getName();
            $data['field_image'] = $imageName;
        }

        session()->setFlashdata('message', 'Succesfully edit field');
        $this->fieldModel->save($data);
        return redirect()->to('/manage-field');
    }

    public function approve($bookingId) {
        $this->bookingModel->approve($bookingId);
        return redirect()->to('/booking-history');
    }
}
