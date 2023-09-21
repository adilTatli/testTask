<?php

namespace App\Controllers;

use App\Models\UserModel;

class AccountController
{
    /**
     * Display user account information and handle updates.
     *
     * @return void
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $hashedPassword = null;
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            }

            $userModel = new UserModel();

            $success = $userModel->updateUser($userId, $name, $phone, $email, $hashedPassword);

            if ($success) {
                $_SESSION['user_name'] = $name;
                $_SESSION['user_phone'] = $phone;
                $_SESSION['user_email'] = $email;

                if (!empty($hashedPassword)) {
                    $_SESSION['user_password'] = $password;
                }


                $successMessages['update'] = 'Данные успешно обновлены';
                header('Location: /account');
                exit();
            } else {

                die('Ошибка при обновлении данных пользователя.');
            }
        }

        require __DIR__ . '/../Views/user_account.php';
    }
}