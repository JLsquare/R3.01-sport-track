<?php
require_once(__ROOT__.'/controllers/Controller.php');

class DisconnectUserController extends Controller
{
    /**
     * Handles user disconnection. If the user is not currently logged in,
     * redirects to the main page with an error message.
     * Otherwise, terminates the session and redirects to the user disconnect page.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
            $this->render('main', ['error' => 'Pas de session ouverte.']);
            return;
        }

        session_destroy();
        $this->render('user_disconnect', []);
    }
}