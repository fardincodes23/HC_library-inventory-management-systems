<?php
require_once __DIR__ . '/../config/config.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = $this->userModel->findByUsername($username);

            if ($user && $this->userModel->verifyPassword($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header('Location: index.php');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        }

        include __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if ($username === '' || $password === '') {
                $error = 'All fields are required.';
            } elseif ($password !== $confirm_password) {
                $error = 'Passwords do not match.';
            } elseif ($this->userModel->findByUsername($username)) {
                $error = 'Username already exists.';
            } else {
                // Creates a new user with the default 'USER' role
                if ($this->userModel->create($username, $password)) {
                    $success = 'Registration successful! You can now login.';
                } else {
                    $error = 'Error during registration.';
                }
            }
        }

        include __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
?>
