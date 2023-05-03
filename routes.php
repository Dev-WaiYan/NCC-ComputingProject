<?php

define("BASE_URL", "/Projects/ncc/NCC-ComputingProject");
$__path = str_replace(BASE_URL, "", $_SERVER['REQUEST_URI']);
$__path = explode("?", $__path)[0];
$__app = 'pages';


// start - middleware
// if (!isset($_SESSION['userId'])) {
//     if (!str_contains($__path, 'home') && !str_contains($__path, 'information') && !str_contains($__path, 'feature') && !str_contains($__path, 'local-attraction') && !str_contains($__path, 'register') && !str_contains($__path, 'login')) {
//         header('Location: ' . 'login');
//     }
// } else if (isset($_SESSION['userId'])) {
//     if (str_contains($__path, 'register') || str_contains($__path, 'login')) {
//         header('Location: ' . 'home');
//     }
// }
// end - middleware


switch ($__path) {
        // start - test
    case '/test':
        $__app .= "/test/index.php";
        break;
        // end - test

        // start - api
    // case '/api/v1/login':
    //     require_once "controller/api/AccountController.php";
    //     AccountController::login();
    //     break;
    // case '/api/v1/register':
    //     require_once "controller/api/AccountController.php";
    //     AccountController::register();
    //     break;
    // case '/api/v1/contact':
    //     require_once "controller/api/ContactController.php";
    //     ContactController::submitContact();
    //     break;
    // case '/api/v1/review':
    //     require_once "controller/api/ReviewController.php";
    //     ReviewController::submitReview();
    //     break;
    // case '/api/v1/pitch-booking':
    //     require_once "controller/api/BookingController.php";
    //     BookingController::pitchBooking();
    //     break;
    // case '/api/v1/swimming-session-booking':
    //     require_once "controller/api/BookingController.php";
    //     BookingController::swimmingSessionBooking();
    //     break;
    // case '/api/v1/area_pitch_info':
    //     require_once "controller/api/BookingController.php";
    //     BookingController::getAreaPitchInfo();
    //     break;
    // case '/api/v1/area_swimming_session_info':
    //     require_once "controller/api/BookingController.php";
    //     BookingController::getAreaSwimmingSessionInfo();
    //     break;
        // end - api

        // start - page routes
    case '/':
    case '/home':
        require_once "controller/HomeController.php";
        $__app .= HomeController::view();
        break;
    case '/products':
        require_once "controller/ProductController.php";
        $__app .= ProductController::view();
        break;
    // case '/contact':
    //     require_once "controller/ContactController.php";
    //     $__app .= ContactController::view();
    //     break;
    // case '/give-review':
    //     require_once "controller/ReviewController.php";
    //     $__app .= ReviewController::view();
    //     break;
    // case '/privacy-policy':
    //     require_once "controller/PrivacyPolicyController.php";
    //     $__app .= PrivacyPolicyController::view();
    //     break;
    // case '/login':
    //     require_once "controller/AccountController.php";
    //     $__app .= AccountController::loginView();
    //     break;
    // case '/logout':
    //     require_once "controller/AccountController.php";
    //     AccountController::logout();
    //     break;
    // case '/register':
    //     require_once "controller/AccountController.php";
    //     $__app .= AccountController::registerView();
    //     break;
    // default:
    //     if (isset($_SESSION['userId'])) {
    //         require_once "controller/HomeController.php";
    //         $__app .= HomeController::view();
    //     } else {
    //         require_once "controller/AccountController.php";
    //         $__app .= AccountController::loginView();
    //     }
        // end - page routes
}

// if request is not to api, will require template.
if (!str_contains($__path, '/api/v1')) {
    require_once 'templates/layout.php';
}
