<?php

use model\UserDAO;

require_once(__ROOT__.'/controllers/Controller.php');

class ConnectUserController extends Controller
{
    /**
     * Renders the main page.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        $this->render('main', []);
    }

    /**
     * Handles user authentication based on provided email and password.
     * If authentication is successful, sets the session and redirects to the panel.
     * If not, it redirects back to the main page with an error message.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userDAO = UserDAO::getInstance();
        $user = $userDAO->find($request['email'], $request['password']);

        if ($user != null) {
            $_SESSION['email'] = $request['email'];
            $_SESSION['password'] = $request['password'];

            $this->render('panel', ['user' => $user]);
        } else {
            $this->render('main', ['error' => 'Email ou mot de passe incorrect']);
        }
    }
}

?>
