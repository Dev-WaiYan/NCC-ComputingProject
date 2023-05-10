<?php

header('Content-Type: application/json');
class AccountController
{
    public static function register()
    {
        $userData = array(
            'name' => $_POST['userName'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        );

        try {
            // check existing user
            $conditions = array(
                'where' => array(
                    'email' => $_POST['email']
                ),
                'return_type' => 'single'
            );
            $existingUser = Db::select('customers', $conditions);

            if ($existingUser) {
                echo json_encode(array('status' => 'ok', 'error' => '', 'existedUser' => true));
            } else {
                $lastInsertId = Db::insert('customers', $userData);
                echo json_encode(array('status' => 'ok', 'error' => '', 'userId' => $lastInsertId));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'error' => $e->getMessage()));
        }
    }


    public static function login()
    {
        $conditions = array(
            'where' => array(
                'email' => $_POST['email']
            ),
            'return_type' => 'single'
        );

        try {
            $user = Db::select('customers', $conditions);

            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['userId'] = $user['id'];

                echo json_encode(array('status' => 'ok', 'error' => '', 'user' => [
                    'id' => $user['id'],
                ]));
            } else {
                echo json_encode(array('status' => 'ok', 'error' => '', 'user' => null));
            }
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
