<?php

header('Content-Type: application/json');
class AccountController
{
    public static function register()
    {
        $userData = array(
            'user_name' => $_POST['newAccountUsername'],
            'password' => password_hash($_POST['newAccountPassword'], PASSWORD_DEFAULT),
            'role_id' => $_POST['role'],
        );

        try {
            // check existing user
            $conditions = array(
                'where' => array(
                    'user_name' => $_POST['newAccountUsername']
                ),
                'return_type' => 'single'
            );
            $existingUser = Db::select('admins', $conditions);

            if ($existingUser) {
                echo json_encode(array('status' => 'ok', 'error' => '', 'existedUser' => true));
            } else {
                $lastInsertId = Db::insert('admins', $userData);
                echo json_encode(array('status' => 'ok', 'error' => '', 'adminId' => $lastInsertId));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }


    public static function login()
    {
        $conditions = array(
            'where' => array(
                'user_name' => $_POST['userName']
            ),
            'return_type' => 'single'
        );

        try {
            $admin = Db::select('admins', $conditions);

            if ($admin && password_verify($_POST['password'], $admin['password'])) {
                $_SESSION['adminId'] = $admin['id'];
                $_SESSION['roleId'] = $admin['role_id'];
                $_SESSION['userName'] = $admin['user_name'];

                echo json_encode(array('status' => 'ok', 'error' => '', 'admin' => [
                    'id' => $admin['id'],
                ]));
            } else {
                echo json_encode(array('status' => 'ok', 'error' => '', 'admin' => null));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }


    public static function updateAccount()
    {
        $data = array(
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        );

        try {
            AccountService::updateAccount($_SESSION['adminId'], $data);
            echo json_encode(array('status' => 'ok', 'error' => ''));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }

    public static function logout()
    {
        try {
            echo json_encode(array('status' => 'ok', 'error' => '', 'success' => session_destroy()));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }
}
