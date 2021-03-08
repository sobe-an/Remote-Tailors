<?php


class Tailors extends Controller
{

    private $tailorModel;

    public function __construct()
    {
        $this->tailorModel = $this->model('Tailor');

    }

    public function signup()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'email' => trim($_POST['email']),
                'username' => trim($_POST['uname']),
                'password' => trim($_POST['password']),
                'fname_err' => '',
                'lname_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => ''];

            // Check if entries are empty
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter you First name';
            }
            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter your Last name';
            }

            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter a unique username';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check if entries are unique
            if (!empty($data['username'])) {
                if ($tailors = $this->tailorModel->getTailorByUser($data['username'])) {
                    $data['username_err'] = 'Please enter a unique username';
                }
            }

            if (!empty($data['email'])) {
                if ($tailors = $this->tailorModel->getTailorByEmail($data['email'])) {
                    $data['email_err'] = 'This email address in invalid';
                }
            }


            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['password_err']) && empty($data['username_err'])) {

                // Register User
                $registered = $this->tailorModel->register($data['email'], $data['password']);

                if ($registered) {
                    // Create Session
                    $this->createSession($registered);
                } else {
                    $this->view('tailors/register', $data);
                }
            }


        } else {
            // Init data
            $data = [
                'fname' => '',
                'lname' => '',
                'email' => '',
                'username' => '',
                'password' => '',
                'fname_err' => '',
                'lname_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('pages/signup', $data);
        }
    }

    public function signin()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''];

            // Check if entries are empty
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            if (!empty($data['email'])) {
                if (!$this->tailorModel->getTailorByEmail($data['email'])) {
                    $data['email_err'] = 'User not found';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Check and set logged in user
                $loggedin = $this->tailorModel->login($data['email'], $data['password']);

                if ($loggedin) {
                    // Create Session
                    $this->createSession($loggedin);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('tailors/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('tailors/login', $data);
            }


        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('tailors/login', $data);
        }
    }

    public function createSession($tailor)
    {
        print_r($_SESSION);
        $_SESSION['id'] = $tailor['tailor_id'];
        $_SESSION['email'] = $tailor['tailor_email'];
        header('location: ' . URL_ROOT . 'profile/index');
    }

    public function signout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['email']);
        session_destroy();
        header('location: ' . URL_ROOT . 'tailors/signin');
    }

}
