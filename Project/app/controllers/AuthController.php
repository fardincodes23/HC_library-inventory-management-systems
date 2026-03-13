<?php
require_once __DIR__ . '/../config/config.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username && $password) {
                // 1. Get the user from the database
                $user = $this->userModel->getByUsername($username);

                // 2. Verify the user exists AND the password matches the hash
                if ($user && password_verify($password, $user['password_hash'])) {

                    // 3. Set the session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'] ?? 'STAFF';

                    // 4. Send them to the dashboard/books page
                    header('Location: index.php?page=books');
                    exit;
                } else {
                    $error = 'Invalid username or password.';
                }
            } else {
                $error = 'Please enter both username and password.';
            }
        }

        // Load the login view if not POST or if there was an error
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
            } elseif ($this->userModel->getByUsername($username)) {
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
