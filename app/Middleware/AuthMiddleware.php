<?php

namespace App\Middleware;

class AuthMiddleware
{
    /**
     * Redirects to the login page if the user is not authenticated.
     *
     * @return void
     */
    public function handle()
    {
        if (!isset($_SESSION['user_email'])) {
            header('Location: /login');
            exit();
        }
    }
}