<?php

$__path = str_replace(BASE_URL, "", $_SERVER['REQUEST_URI']);
$__path = explode("?", $__path)[0];
$__app = 'pages';


// start - middleware
if (str_contains($__path, 'admin')) {
    if (!isset($_SESSION['adminId']) && !str_contains($__path, 'admin/login') && !str_contains($__path, 'api/v1/login')) {
        header("Location: " . BASE_URL . "/admin/login");
    } else if (isset($_SESSION['adminId']) && str_contains($__path, 'admin/login')) {
        header("Location: " . BASE_URL . "/admin/profile");
    }
} else if (isset($_SESSION['userId'])) {
    if (str_contains($__path, 'register') || str_contains($__path, 'login')) {
        header("Location: " . BASE_URL . "/home");
    }
}
// end - middleware


switch ($__path) {
        // api routes
        // start - Admin api routes
    case '/admin/api/v1/login':
        require_once 'services/admin/AccountService.php';
        require_once "controller/api/admin/AccountController.php";
        AccountController::login();
        break;
    case '/admin/api/v1/register':
        require_once 'services/admin/AccountService.php';
        require_once "controller/api/admin/AccountController.php";
        AccountController::register();
        break;
    case '/admin/api/v1/logout':
        require_once "controller/api/admin/AccountController.php";
        AccountController::logout();
        break;
    case '/admin/api/v1/account/update':
        require_once 'services/admin/AccountService.php';
        require_once "controller/api/admin/AccountController.php";
        AccountController::updateAccount();
        break;
    case '/admin/api/v1/paymentDecision':
        require_once 'services/common/OrderService.php';
        require_once 'services/common/PaymentService.php';
        require_once "controller/api/admin/PaymentController.php";
        PaymentController::updateForPayment();
        break;
    case '/admin/api/v1/deliComplete':
        require_once 'services/common/OrderService.php';
        require_once "controller/api/admin/OrderController.php";
        OrderController::deliComplete();
        break;
    case '/admin/api/v1/report':
        require_once 'services/common/OrderService.php';
        require_once 'services/common/PaymentService.php';
        require_once "controller/api/admin/ReportController.php";
        ReportController::report();
        break;
    case '/admin/api/v1/category':
        require_once 'services/admin/CategoryService.php';
        require_once "controller/api/admin/CategoryController.php";
        if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_REQUEST['id'])) {
            CategoryController::show();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            CategoryController::add();
        } else if ($_SERVER["REQUEST_METHOD"] === "PUT") {
            CategoryController::update();
        } else if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            CategoryController::delete();
        }
        break;
    case '/admin/api/v1/product':
        require_once 'services/admin/ProductService.php';
        require_once "controller/api/admin/ProductController.php";
        if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_REQUEST['id'])) {
            ProductController::show();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_REQUEST['id'])) {
            ProductController::update();
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            ProductController::add();
        } else if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            ProductController::delete();
        }
        break;
        // end - Admin api routes

        // start - client api routes
    case '/api/v1/login':
        require_once "controller/api/AccountController.php";
        AccountController::login();
        break;
    case '/api/v1/logout':
        require_once "controller/api/AccountController.php";
        AccountController::logout();
        break;
    case '/api/v1/register':
        require_once "controller/api/AccountController.php";
        AccountController::register();
        break;
    case '/api/v1/checkout':
        require_once 'services/common/OrderService.php';
        require_once 'services/common/PaymentService.php';
        require_once "controller/api/OrderController.php";
        OrderController::checkout();
        break;
    case '/api/v1/feedback':
        require_once 'services/common/FeedbackService.php';
        require_once "controller/api/FeedbackController.php";
        FeedbackController::create();
        break;
        // end - client api routes
        // end - api routes

        // start - page routes
        // admin routes
    case '/admin':
    case '/admin/':
    case '/admin/login':
        require_once "controller/admin/AccountController.php";
        $__app .= AccountController::loginView();
        break;
    case '/admin/profile':
        require_once "controller/admin/AccountController.php";
        $__app .= AccountController::view();
        break;
    case '/admin/category':
        require_once "controller/admin/CategoryController.php";
        $__app .= CategoryController::view();
        break;
    case '/admin/product':
        require_once "controller/admin/ProductController.php";
        $__app .= ProductController::view();
        break;
    case '/admin/order':
        require_once "controller/admin/OrderController.php";
        $__app .= OrderController::view();
        break;
    case '/admin/report':
        require_once "controller/admin/ReportController.php";
        $__app .= ReportController::view();
        break;

        // user routes
    case '/':
    case '/home':
        require_once "controller/HomeController.php";
        $__app .= HomeController::view();
        break;
    case '/products':
        require_once "controller/ProductController.php";
        $__app .= ProductController::view();
        break;
    case '/myorders':
        require_once "controller/MyOrderController.php";
        $__app .= MyOrderController::view();
        break;
    case '/login':
        require_once "controller/AccountController.php";
        $__app .= AccountController::loginView();
        break;
    case '/register':
        require_once "controller/AccountController.php";
        $__app .= AccountController::registerView();
        break;
    default:
        header("Location: " . BASE_URL . "/home");
        // end - page routes
}

// if request is not to api, will require template.
if (!str_contains($__path, '/api/v1') && !str_contains($__path, '/admin')) {
    require_once 'templates/layout.php';
}

if (!str_contains($__path, '/api/v1') && str_contains($__path, '/admin')) {
    require_once 'templates/adminLayout.php';
}
