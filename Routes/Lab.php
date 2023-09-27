<?php

/**
 * The Lab Controller is used for experimenting and simulating various scenarios.
 *
 * This controller can be used to test functionalities, such as sending emails and handling exceptions.
 */
class Lab extends Controller
{
    /**
     * Lab constructor.
     *
     * This constructor initializes the Lab Controller.
     */
    public function Index()
    {        
        // Load the Lab/Index view
        $this->view('Lab/Index');
    }
}
