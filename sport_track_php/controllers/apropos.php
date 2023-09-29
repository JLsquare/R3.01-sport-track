<?php
require_once(__ROOT__.'/controllers/Controller.php');

class AProposController extends Controller
{
    /**
     * Renders the "apropos" page.
     * @param array $request The HTTP request parameters.
     * @return void
     */
    public function get($request): void
    {
        $this->render('apropos',[]);
    }
}