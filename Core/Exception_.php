<?php
/**
 * Weaver Framework - Custom Exception Class
 *
 * This class overrides the default Exception class and provides additional functionality for handling exceptions.
 */

class Exception_ extends Exception
{
    /**
     * Constructor for the custom exception class.
     *
     * @param string $message   The error message.
     * @param int    $code      The error code.
     * @param \Exception $previous The previous exception, if any.
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        // Call the parent class constructor
        parent::__construct($message, $code, $previous);

        // Log the error message and stack trace
        System::logError($message . "\n" . $this->getTraceAsString());
    }
}
