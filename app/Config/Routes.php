<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');
$routes->get('/forgot-password', 'Auth::forgotPassword');
$routes->post('/forgot-password', 'Auth::attemptForgotPassword');
$routes->get('/reset-password/(:any)', 'Auth::resetPassword/$1');
$routes->post('/reset-password', 'Auth::attemptResetPassword');
$routes->get('/logout', 'Auth::logout');

// Profile
$routes->get('/profile', 'Profile::profile');
$routes->get('/edit-profile', 'Profile::editProfile');
$routes->post('/edit-profile', 'Profile::attemptEditProfile');
$routes->get('/change-password', 'Profile::changePassword');
$routes->post('/change-password', 'Profile::attemptChangePassword');

// Admin
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/manage-member', 'Admin::manageMember');
$routes->get('/manage-owner', 'Admin::manageOwner');
$routes->get('/manage-admin', 'Admin::manageAdmin');
$routes->get('/owner-approval', 'Admin::ownerApproval');
$routes->get('/approve-owner/(:any)', 'Admin::approveOwner/$1');
$routes->get('/reject-owner/(:any)', 'Admin::rejectOwner/$1');
$routes->get('/set-as-member/(:any)', 'Admin::setAsMember/$1');
$routes->get('/set-as-owner/(:any)', 'Admin::setAsOwner/$1');
$routes->get('/set-as-admin/(:any)', 'Admin::setAsAdmin/$1');

// Owner
$routes->get('/booking-history', 'Owner::bookingHistory');
$routes->get('/booking-approval', 'Owner::bookingApproval');
$routes->get('/manage-field', 'Owner::manageField');
$routes->post('/manage-field', 'Owner::attemptManageField');
$routes->get('/approve/(:any)', 'Owner::approve/$1');

// Member
$routes->get('/find-field', 'Member::findField');
$routes->post('/find-field/filter', 'Member::filterField');
$routes->get('/field/(:any)', 'Member::detailField/$1');
$routes->get('/booking', 'Member::booking');
$routes->get('/history', 'Member::history');
$routes->get('/detail-booking/(:any)', 'Member::detailBooking/$1');
$routes->post('/booking-confirmation', 'Member::bookingConfirmation');
$routes->get('/owner-request', 'Member::ownerRequest');
$routes->post('/owner-request', 'Member::attemptOwnerRequest');

$routes->get('/team', 'Member::team');
$routes->get('/create-team', 'Member::createTeam');
$routes->get('/assign-leader', 'Member::assignLeader');
$routes->post('/assign-leader', 'Member::attemptAssignLeader');
$routes->post('/create-team', 'Member::attemptCreateTeam');
$routes->get('/join-team/(:any)', 'Member::joinTeam/$1');
$routes->post('/exit-team/', 'Member::exitTeam');
$routes->post('/upload-receipt', 'Member::uploadReceipt');

$routes->get('/available-fields', 'AvailableFields::downloadPdf');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
