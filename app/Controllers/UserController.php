<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    /**
     * User registration and validation.
     *
     * @return void
     */
    public function index()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeatPass = $_POST['repeatPassword'];

            $errors = $this->validateRegistration($name, $email, $phone, $password, $repeatPass);

            if (empty($errors)) {
                $userModel = new UserModel();

                $emailOrPhoneExists = $userModel->emailOrPhoneExists($email, $phone);

                if ($emailOrPhoneExists) {
                    $errors['email'] = 'Данный логин уже существуют';
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    $success = $userModel->createUser($name, $phone, $email, $hashedPassword);

                    $userId = $userModel->getUserId($email);

                    if ($success) {
                        $_SESSION['user_id'] = $userId;
                        $_SESSION['user_name'] = $name;
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_phone'] = $phone;
                        $_SESSION['user_password'] = $password;

                        header('Location: /account');
                        exit();
                    }
                }
            }
        }

        require __DIR__ . '/../Views/registration.php';
    }

    /**
     * User authorization and validation.
     *
     * @return void
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $emailOrPhone = $_POST['emailOrPhone'];
            $password = $_POST['password'];

            $userModel = new UserModel();

            $user = $userModel->getUserByEmailOrPhone($emailOrPhone);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_phone'] = $user['phone'];
                $_SESSION['user_password'] = $password;

                header('Location: /account');
                exit();
            } else {
                $errors['login'] = 'Неправильные учетные данные';
            }
        }

        require __DIR__ . '/../Views/auth.php';
    }
}