<?php

use model\User;
use model\UserDAO;

require_once(__ROOT__ . '/controllers/Controller.php');
require_once(__ROOT__ . '/model/User.php');
require_once(__ROOT__ . '/model/UserDAO.php');

class AddUserController extends Controller
{
    /**
     * Renders the user addition form.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request) {
        $this->render('user_add_form', []);
    }

    /**
     * Processes the user addition form's POST request.
     * Validates the password length, initializes a new user, and attempts to insert the user into the database.
     * If successful, the user sees a validation page; otherwise, an error message is displayed.
     * @param array $request The HTTP request parameters, including email, password, and other user details.
     * @return void
     */
    public function post($request): void
    {
        if (strlen($request['password']) < 8) {
            $this->render('user_add_form', ['error' => 'Veuillez utiliser un mot de passe de 8 character minimum.']);
            return;
        }

        $user = new User();
        $user->init($request['email'], $request['password'], $request['firstname'], $request['lastname'], $request['birthdate'], $request['gender'], $request['height'], $request['weight']);
        $userDAO = UserDAO::getInstance();

        try {
            $userDAO->insert($user);
        } catch (Exception $e) {
            $this->render('user_add_form', ['error' => 'Erreur lors de l\'enregistrement de l\'utilisateur.', 'errorlog' => $e->getMessage()]);
            return;
        }

        $this->render('user_add_valid', ['firstname' => $request['firstname'], 'lastname' => $request['lastname']]);
    }
}
