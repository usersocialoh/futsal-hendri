<?php

namespace App\Controllers;

use App\Models\FieldModel;
use App\Models\ForgotPasswordModel;
use App\Models\OwnerRequestModel;
use App\Models\UserModel;
use App\Models\TeamModel;
use App\Models\BookingModel;
use App\Models\DetailBookingModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        helper('global');
        $this->session = \Config\Services::session();
        $this->session->start();
        session();
        $this->userModel = new UserModel();
        $this->fieldModel = new FieldModel();
        $this->teamModel = new TeamModel();
        $this->detailBookingModel = new DetailBookingModel();
        $this->bookingModel = new BookingModel();
        $this->forgotPasswordModel = new ForgotPasswordModel();
        $this->ownerRequestModel = new OwnerRequestModel();

        $userId = $this->session->get('user_id');
        $this->user = $this->userModel->getUserById($userId);
        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = \Config\Services::session();
    }
}
