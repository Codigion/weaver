<?php

/**
 * Weaver Framework - System Class
 *
 * This class provides common system-related tasks such as error handling, logging, and environment variable loading.
 */

class System
{
    /**
     * Display an error page with a stack trace.
     *
     * @param Exception_ $exception The exception to display.
     * @return void
     */
    public static function displayErrorPage(Exception_ $exception)
    {
        http_response_code(500); // Set a 500 Internal Server Error status code

        // Include a custom error page with the stack trace
        require_once "Views/Error/500.php";
        die();
    }

    /**
     * Logs an error message to an error log file with a timestamp.
     *
     * @param string $errorMessage The error message to log.
     * @return void
     */
    public static function logError($errorMessage)
    {
        try {
            // Format the error message with a timestamp
            $formattedErrorMessage = '[' . date('d/m/Y H:i:s') . '] ' . $errorMessage . "\n";

            // Define the path to the error log file
            $errorLogFilePath = './error.log';

            // Create the error log file if it doesn't exist
            if (!file_exists($errorLogFilePath)) {
                touch($errorLogFilePath);
            }

            // Append the formatted error message to the error log file
            file_put_contents($errorLogFilePath, $formattedErrorMessage, FILE_APPEND);
        } catch (Exception_ $e) {
            // Handle the exception or log the error
            System::displayErrorPage($e);
        }
    }


    /**
     * Load Configuration from a .env File and Define Constants.
     *
     * This method reads a .env file and defines constants for environment variables. If the .env file
     * is not found, default values are used for these constants. If a constant is already defined,
     * it will not be overridden.
     *
     * @param string $filePath The path to the .env file. Defaults to 'Configurations/.env'.
     * @return void
     */
    public static function loadEnvironmentVariables($filePath = 'Configurations/.env')
    {
        try {
            if (file_exists($filePath)) {
                // Apply configuration if the .env file exists
                $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($lines as $line) {
                    if (strpos($line, '=') !== false) {
                        list($key, $value) = explode('=', $line, 2);
                        $key = trim($key);
                        $value = trim($value);
                        if (!defined($key)) {
                            define($key, $value);
                        }
                    }
                }
            } else {
                // Define default values if the .env file doesn't exist
                if (!defined('ENVIRONMENT')) {
                    define('ENVIRONMENT', 'development');
                }

                if (!defined('MYSQL_HOST')) {
                    define('MYSQL_HOST', 'localhost');
                }

                if (!defined('MYSQL_USERNAME')) {
                    define('MYSQL_USERNAME', 'root');
                }

                if (!defined('MYSQL_PASSWORD')) {
                    define('MYSQL_PASSWORD', '');
                }

                if (!defined('MYSQL_DATABASE')) {
                    define('MYSQL_DATABASE', 'phpmyadmin');
                }

                if (!defined('SENDER_EMAIL')) {
                    define('SENDER_EMAIL', '');
                }

                if (!defined('SENDER_PASSWORD')) {
                    define('SENDER_PASSWORD', '');
                }

                if (!defined('PROJECT_NAME')) {
                    define('PROJECT_NAME', 'Weaver v1.0.0');
                }
            }
        } catch (Exception_ $e) {
            // Handle the exception or log the error
            System::displayErrorPage($e);
        }
    }



    /**
     * Load a model class dynamically.
     *
     * @param string $modelName The name of the model to load (without the .php extension).
     * @return object|null An instance of the loaded model or null if the model file is not found.
     */
    public static function loadModel($modelName)
    {
        try {
            // Construct the file path for the model
            $modelFilePath = 'Models/' . $modelName . '.php';

            // Check if the model file exists
            if (file_exists($modelFilePath)) {
                // Include the model file
                include $modelFilePath;

                // Check if the model class exists
                if (class_exists($modelName)) {
                    // Create and return an instance of the loaded model
                    return new $modelName();
                } else {
                    throw new Exception_("#System: Model class not found: $modelName.");
                }
            } else {
                throw new Exception_("#System: Model file not found: $modelFilePath.");
            }
        } catch (Exception_ $e) {
            // Handle the exception or log the error
            System::displayErrorPage($e);
        }
    }
}
