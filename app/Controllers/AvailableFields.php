<?php

namespace App\Controllers;
use Dompdf\Dompdf;

use App\Models\FieldModel;

class AvailableFields extends BaseController{

    public function __construct() {
    }

    public function index(){

    }

    public function downloadPdf(){
        $dompdf = new Dompdf();

        $html = view('available_fields/pdf');
        $dompdf>loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }

    public function manageMember(){
        $member = $this->userModel->getAllMember();
        $data = [
            "user" => $this->user,
            "title" => "Manage Member",
            "isSidebarHidden" => false,
            "member"=> $member
        ];
        return view('admin/manage-member', $data);
    }

    public function manageAdmin(){
        $admin = $this->userModel->getAllAdmin();
        $data = [
            "user" => $this->user,
            "title" => "Manage admin",
            "isSidebarHidden" => false,
            "admin"=> $admin
        ];
        return view('admin/manage-admin', $data);
    }

    public function manageOwner(){
        $owner = $this->userModel->getAllOwner();
        $data = [
            "user" => $this->user,
            "title" => "Manage Owner",
            "isSidebarHidden" => false,
            "owner"=> $owner
        ];
        return view('admin/manage-owner', $data);
    }

    public function ownerApproval(){
        $owner = $this->ownerRequestModel->getAllOwnerRequest();
        $data = [
            "user" => $this->user,
            "title" => "Owner Approval",
            "isSidebarHidden" => false,
            "owner"=> $owner
        ];
        return view('admin/owner-approval', $data);
    }

    public function setAsMember($userId) {
        $this->userModel->setAsMember($userId);
        return redirect()->to('/manage-member');
    }

    public function setAsOwner($userId) {
        $this->userModel->setAsOwner($userId);
        $fieldModel = new FieldModel();
        $fieldModel->save(["owner_id"=>$userId]);
        return redirect()->to('/manage-owner');
    }
    public function setAsAdmin($userId) {
        $this->userModel->setAsAdmin($userId);
        return redirect()->to('/manage-admin');
    }

    public function approveOwner($ownerRequestId) {
        $this->userModel->approveOwner($ownerRequestId);
        return redirect()->to('/owner-approval');
    }

    public function rejectOwner($userId) {
        $this->userModel->setAsMember($userId);
        return redirect()->to('/manage-member');
    }
}
