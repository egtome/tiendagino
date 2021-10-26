<?php

class LoginService
{
    public const DEFAULT_PASSWORD_HASH = PASSWORD_BCRYPT;
    public const SUCCESS_REDIRECT = '/clients';
    public const ERROR_REDIRECT = '/login';
    public const AUTH_ERROR_SESSION_KEY = 'AUTH_ERROR';     

    public function loginUser(?string $userName, ?string $password): bool
    {
        $userModel = new UserModel();
        $userModel->setUserName($userName);
        $user = $userModel->getPasswordByUserName();
        $userPassword = $user[0]['password'] ?? '';
        if (!password_verify($password, $userPassword)) {
            session_destroy();
            session_start();
            $_SESSION[self::AUTH_ERROR_SESSION_KEY] = true;
            return false;
        }
        unset($_SESSION[self::AUTH_ERROR_SESSION_KEY]);
        $_SESSION['username'] = $userName;

        return true;
    }

    public function isUserLogedIn(): bool
    {
        return !empty($_SESSION['username']);
    }

}