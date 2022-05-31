<?php

namespace App\Controllers;

class Profile extends BaseController{
    public function __construct() {
    }

    public function profile(){
        $data = [
            "title" => "Profile",
            "isSidebarHidden" => false,
            "user" => $this->user
        ];
        return view('profile/profile', $data);
    }

    public function editProfile(){
        $data = [
            "title" => "Edit Profile",
            "isSidebarHidden" => false,
            "user" => $this->user,
            "validation" => \Config\Services::validation()
        ];
        return view('profile/edit-profile', $data);
    }

    public function changePassword(){
        $data = [
            "title" => "Profile",
            "isSidebarHidden" => false,
            "user" => $this->user,
            "validation" => \Config\Services::validation()
        ];
        return view('profile/change-password', $data);
    }
// code for edit user profile
    public function attemptEditProfile(){
        $validator = [
            'user_id' => [
                'label' => 'user id',
                'rules' => 'required'
            ],
            'email' => 'required|is_unique[user.email, user_id, {user_id}]',
            'name' => "required",
            'phone_number' => [
                'label' => 'phone number',
                'rules' => 'required|is_unique[user.phone_number, user_id, {user_id}]'
            ],
            'image' => [
                'rules' => 'max_size[image,10240]|is_image[image]
                |mime_in[image,image/jpg,image/jpeg,image/png]'
            ]
        ];

        $data = [
            'user_id' => $this->request->getVar('user_id'),
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'phone_number' => $this->request->getVar('phone_number')
        ];
        if (!$this->validate($validator)) {
            return redirect()->to('/edit-profile')->withInput();
        }
        $image = $this->request->getFile('image');
        if ($image->getSize()>0) {
            $image->move('assets/img/profile');
            $imageName = $image->getName();
            $data['image'] = $imageName;
            $this->user['image'] = $data['image'];
        }
        $this->userModel->save($data);
        $this->user['email'] = $data['email'];
        $this->user['name'] = $data['name'];
        $this->user['phone_number'] = $data['phone_number'];
        session()->setFlashdata('message', 'Successfuly changed profile!');
        return redirect()->to('/profile');
    }
// code for change password
    public function attemptChangePassword(){
        $validator = [
            'old_password' => [
                'label' => 'old password',
                'rules' => 'required'
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required|matches[password_confirmation]'
            ],
            'password_confirmation' => [
                'label' => 'password confirmation',
                'rules' => 'required|matches[password]'
            ],
        ];
        if (!$this->validate($validator)) {
            return redirect()->to('/change-password')->withInput();
        }

        $passwordConfirmation =  $this->request->getVar('password_confirmation');
        $password = $this->request->getVar('password');
        if ( $password != $passwordConfirmation) {
            session()->setFlashdata('error', 'Password doesnt match!');
            return redirect()->to('/change-password');
        }
        $oldPassword =  $this->request->getVar('old_password');
        if ($oldPassword != $this->user['password']) {
            session()->setFlashdata('error', 'Old password is wrong!');
            return redirect()->to('/change-password');
        }
        $userId = $this->user['user_id'];
        $this->userModel->changePassword($userId, $password);
        session()->setFlashdata('message', 'Successfuly changed password!');
        $this->user['password'] = $password;
        return redirect()->to('/profile');
    }
}
