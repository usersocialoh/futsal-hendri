<?php

namespace App\Controllers;

class Auth extends BaseController{

    public function __construct(){
        $this->email = \Config\Services::email();
    }

    public function login() {
        $data = [
            "title" => 'Login',
            "validation" => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function register() {
        $data = [
            "title" => 'Register',
            "validation" => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }

    public function forgotPassword() {
        $data = [
            "title" => 'Forgot Password',
            "validation" => \Config\Services::validation()
        ];
        return view('auth/forgot-password', $data);
    }

    public function resetPassword($link) {
        $request = $this->forgotPasswordModel->getRequest($link);
        if (!$request) {
            session()->setFlashdata('error', 'Link is invalid');
            return redirect()->to('/login');
        }
        if(!$request['is_valid']) {
            session()->setFlashdata('error', 'Link is expired');
            return redirect()->to('/login');
        }
        $data = [
            "title" => 'Reset Password',
            "isSidebarHidden" => true,
            "request" => $request,
            "validation" => \Config\Services::validation()
        ];
        return view('auth/reset-password', $data);
    }
//untuk log in
    public function attemptLogin() {
        $validator = [
            'email' => 'required',
            'password' => 'required',
        ];
        if (!$this->validate($validator)) {
            return redirect()->to('/login')->withInput();
        }
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ];
        $user = $this->userModel->where($data)->first();
        if (!$user) {
            session()->setFlashdata('error', 'Email and password doesnt match any user!');
            return redirect()->to('/login')->withInput();
        }
        $this->session->set('user_id', $user['user_id']);
        return redirect()->to('/profile');
    }
// This is code for register
    public function attemptRegister() {
        $validator = [
            'name' => 'required',
            'email' => 'required|is_unique[user.email]|valid_email',
            'phone_number' => [
                'label' => 'phone number',
                'rules' => 'required|is_unique[user.phone_number]',
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
            return redirect()->to('/register')->withInput();
        }
        $data = [
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'name' => $this->request->getVar('name'),
            'phone_number' => $this->request->getVar('phone_number')
        ];
        $this->userModel->save($data);
        session()->setFlashdata('message', 'Successfully created a new user. Please login!');
        return redirect()->to('/login');
    }

    public function attemptForgotPassword() {
        $validator = [
            'email' => 'required|valid_email'
        ];
        if (!$this->validate($validator)) {
            return redirect()->to('/forgot-password')->withInput();
        }

        $email = $this->request->getVar('email');
        $user = $this->userModel->getUserByEmail($email);
        if (!$user) {
            session()->setFlashdata('error', 'No registered user was found.');
            return redirect()->to('/forgot-password')->withInput();
        }
        $data = [
            'user_id'=> $user['user_id'],
            'link' => md5(date('l jS \of F Y h:i:s A').$user['user_id'] )
        ];

        $this->forgotPasswordModel->save($data);

        $this->email->setFrom('helpdesk.futsal@gmail.com', 'Futsal Admin');
        $this->email->setTo($email);
        $this->email->setSubject('Reset Password');
        $this->email->setMessage('Here is a link to reset your password '. base_url('/reset-password/'.$data['link']));

        if (!$this->email->send()) {
            session()->setFlashdata('message', 'Something went wrong. Please try again!');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('message', 'Successfully. Please check your email!');
            return redirect()->to('/login');
        }
    }

    public function attemptResetPassword() {
        $validator = [
            'password' => 'required|matches[password_confirmation]',
            'password_confirmation' => 'required|matches[password]'
        ];
        if (!$this->validate($validator)) {
            return redirect()->to('/reset-password')->withInput();
        }
        $userId = $this->request->getVar('user_id');
        $requestId = $this->request->getVar('request_id');
        $password = $this->request->getVar('password');
        $this->userModel->changePassword($userId, $password);
        $this->forgotPasswordModel->expire($requestId);
        session()->setFlashdata('message', 'Successfully changed your password');
        return redirect()->to('/login');
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to('/login');
    }

}
