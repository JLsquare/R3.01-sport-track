<?php
require_once(__ROOT__.'/controllers/Controller.php');

class MainController extends Controller
{
    /**
     * Renders the main page.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        $this->render('main',[]);
    }
}

?>
