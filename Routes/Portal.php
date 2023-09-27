<?php
/**
 * Portal Controller
 *
 * This controller handles the main portal page.
 */
class Portal extends Controller
{
    /**
     * Index method
     *
     * This method is the entry point for the portal page.
     * It sets the user's session, loads the header and footer layouts,
     * and displays the "Welcome" view.
     */
    public function index()
    {
        // Set the user's session (Replace 'Mr. Demo' with the actual user)
        Session::set('user', 'Mr. Demo');

        // Load the header layout
        $this->layout('Header');

        // Load and display the "Welcome" view (You can pass data as needed)
        $this->view('Welcome', array());

        // Load the footer layout
        $this->layout('Footer');
    }
}
