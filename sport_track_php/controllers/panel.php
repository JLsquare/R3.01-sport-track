<?php

use model\UserDAO;

require_once(__ROOT__.'/controllers/Controller.php');

class PanelController extends Controller
{
    /**
     * Renders the panel page if the user session exists and is valid, otherwise shows an error or the main page.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'Pas de session ouverte.']);
            return;
        }

        $user = UserDAO::getInstance()->find($_SESSION['email'], $_SESSION['password']);

        if ($user) {
            $this->render('panel', ['user' => $user]);
        } else {
            $this->render('main', ['error' => 'Email ou mot de passe incorrect.']);
        }
    }
}

?>
