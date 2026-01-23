<?php
require_once APP_PATH . '/config/database.php';
require_once APP_PATH . '/models/UserModel.php';

class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        global $mysqli;
        $this->userModel = new UserModel($mysqli);
    }

    // GET+POST /?controller=auth&action=login
    public function login(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = $this->userModel->findByUsername($username);

            if ($user && hash('sha256', $password) === $user['password_hash']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header('Location: index.php?controller=book&action=index');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        }

        include VIEW_PATH . '/auth/login.php';
    }

    // GET+POST /?controller=auth&action=register
    public function register(): void
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm  = trim($_POST['confirm_password'] ?? '');

            if ($username === '' || $password === '' || $confirm === '') {
                $error = 'All fields are required.';
            } elseif ($password !== $confirm) {
                $error = 'Passwords do not match.';
            } elseif ($this->userModel->findByUsername($username)) {
                $error = 'Username already exists.';
            } else {
                if ($this->userModel->create($username, $password, 'USER')) {
                    $success = 'User registered. You can now log in.';
                } else {
                    $error = 'Registration failed.';
                }
            }
        }

        include VIEW_PATH . '/auth/register.php';
    }

    // GET /?controller=auth&action=logout
    public function logout(): void
    {
        session_unset();
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
