<?php

namespace App\Models;

use PDO;
use PDOException;

class UserModel extends BaseModel
{
    /**
     * Checking the existence of a user in the
     * database with the specified email or phone number
     *
     * @param $email
     * @param $phone
     * @return bool|void
     */
    public function emailOrPhoneExists($email, $phone)
    {
        try {
            $query = "SELECT COUNT(*) FROM users WHERE email = ? OR phone = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->bindParam(2, $phone, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            die("Ошибка при проверке email и телефона: " . $e->getMessage());
        }
    }

    /**
     * Search for a user in the database by a given email or phone number
     *
     * @param $emailOrPhone
     * @return mixed|void
     */
    public function getUserByEmailOrPhone($emailOrPhone)
    {
        try {
            $query = "SELECT * FROM users WHERE email = ? OR phone = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $emailOrPhone, PDO::PARAM_STR);
            $stmt->bindParam(2, $emailOrPhone, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return $user;
        } catch (PDOException $e) {
            die("Ошибка при получении пользователя: " . $e->getMessage());
        }
    }

    /**
     * Search for the user ID in the table
     *
     * @param $email
     * @return mixed|void
     */
    public function getUserId($email)
    {
        try {
            $query = "SELECT id FROM users WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();

            $userId = $stmt->fetchColumn();

            return $userId;
        } catch (PDOException $e) {
            die("Ошибка при получении id пользователя по email: " . $e->getMessage());
        }
    }

    /**
     * Request to add a user to the table
     *
     * @param $name
     * @param $phone
     * @param $email
     * @param $password
     * @return true|void
     */
    public function createUser($name, $phone, $email, $password)
    {
        try {
            $query = "INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $phone, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $password, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Ошибка при создании пользователя: " . $e->getMessage());
        }
    }

    /**
     * Request to update the user to the table
     *
     * @param $userId
     * @param $name
     * @param $phone
     * @param $email
     * @param $password
     * @return true|void
     */
    public function updateUser($userId, $name, $phone, $email, $password)
    {
        try {
            $query = "UPDATE users SET name = ?, phone = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $phone, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $password, PDO::PARAM_STR);
            $stmt->bindParam(5, $userId, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Ошибка при обновлении данных пользователя: " . $e->getMessage());
        }
    }
}