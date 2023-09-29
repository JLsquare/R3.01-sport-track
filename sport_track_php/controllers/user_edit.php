<?php

use model\User;
use model\UserDAO;

require_once(__ROOT__ . '/controllers/Controller.php');
require_once(__ROOT__ . '/model/User.php');
require_once(__ROOT__ . '/model/UserDAO.php');

class EditUserController extends Controller
{
    /**
     * Fetches the user's details from the database and displays the user edit form.
     * If no valid user is found, renders the main page with an error message.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userDAO = UserDAO::getInstance();
        $user = $userDAO->find($_SESSION['email'], $_SESSION['password']);
        if (!$user) {
            $this->render('main', ['error' => 'Email or password incorrect']);
            return;
        }

        $this->render('user_edit_form', ['user' => $user]);
    }

    /**
     * Handles the POST request for editing a user's details.
     * If the 'delete' action is chosen, the user is deleted from the database and the session is terminated.
     * If the 'save' action is chosen, updates the user's details in the database.
     * If no valid session exists, renders the main page with an error message.
     * @param array $request The HTTP request parameters, which may include an action choice (delete/save) and user details.
     * @return void
     */
    public function post($request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['email']) || !$_SESSION['email'] || !isset($_SESSION['password']) || !$_SESSION['password']) {
            $this->render('main', ['error' => 'Pas de session ouverte.']);
            return;
        }

        $userDAO = UserDAO::getInstance();

        try {
            if ($request['action'] == 'delete') {
                $user = $userDAO->find($_SESSION['email'], $_SESSION['password']);
                $userDAO->delete($user);
                session_destroy();
                $this->render('main', []);
            } else if ($request['action'] == 'save') {
                $user = new User();
                $password = isset($request['password']) && $request['password'] ? $request['password'] : $_SESSION['password'];
                $user->init($_SESSION['email'], $password, $request['firstname'], $request['lastname'], $request['birthdate'], $request['gender'], $request['height'], $request['weight']);
                $userDAO->update($user);
                $this->render('panel', []);
            }
        } catch (Exception $e) {
            $this->render('user_edit_form', ['user' => $user, 'error' => 'Erreur lors de la modification de l\'utilisateur.', 'errorlog' => $e->getMessage()]);
        }
    }
}