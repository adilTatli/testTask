<?php
declare(strict_types = 1);

namespace App\Controllers;

class BaseController
{
    /**
     * Validates an email address.
     *
     * @param $email
     * @return bool
     */
    private function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * Validates a phone number.
     *
     * @param $phoneNumber
     * @return bool
     */
    private function validatePhoneNumber($phoneNumber)
    {
        $cleanPhoneNumber = trim($phoneNumber);

        if (!preg_match('/^[0-9\-\(\)\s]+$/', $cleanPhoneNumber)) {
            return false;
        }

        return true;
    }

    /**
     * Validates a password and its repeat.
     *
     * @param $password
     * @param $repeatPassword
     * @return bool
     */
    private function validatePassword($password, $repeatPassword) {
        if (empty($password) || empty($repeatPassword) || $password !== $repeatPassword) {
            return false;
        }
        return true;
    }

    /**
     * Validates registration data.
     *
     * @param $name
     * @param $email
     * @param $phone
     * @param $password
     * @param $repeatPassword
     * @return array
     */
    protected function validateRegistration($name, $email, $phone, $password, $repeatPassword)
    {
        $errors = [];

            if (empty($name)) {
                $errors['name'] = 'Имя обязательно для заполнения';
            }

            if (empty($email) || !$this->validateEmail($email)) {
                $errors['email'] = 'Неверный формат email';
            }

            if (empty($phone) || !$this->validatePhoneNumber($phone)) {
                $errors['phone'] = 'Неверный формат номера телефона';
            }

            if (empty($password) || !$this->validatePassword($password, $repeatPassword)) {
                $errors['password'] = 'Пароль и его повтор должны совпадать и быть заполнены';
            }

        return $errors;
    }

}