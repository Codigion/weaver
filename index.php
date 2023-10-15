<?php
/* Start Session */
session_start();


/**
 * Weaver Framework - index.php
 *
 * This is the entry point of the Weaver Framework application. It initializes
 * the project routes and sets error reporting based on the environment.
 *
 * @package WeaverFramework
 */


/**
 * Class Autoloader
 * Load Class when required.
 */
function weaverClassLoader($className)
{
    $directories = [
        __DIR__ . '/Core',
        __DIR__ . '/Helpers',
        __DIR__ . '/Routes',
        __DIR__ . '/Controllers',
    ];

    // Loop through the directories and try to load the class file
    foreach ($directories as $directory) {
        $classFile = $directory . '/' . str_replace('\\', '/', $className) . '.php';
        if (file_exists($classFile)) {
            include $classFile;
            return;
        }
    }
}
// Register the autoload function
spl_autoload_register('weaverClassLoader');



/**
 * Load Environment Variables
 * Create Constants for each environment variables.
 */
System::loadEnvironmentVariables();



/**
 * Set Error reporting, based on Coding Environment.
 * In development, show all errors. 
 * In production, turn off error reporting.
 */
if (ENVIRONMENT == 'development') {
    error_reporting(E_ALL);
} else {
    error_reporting(0); // Turn off error reporting in production
}



/**
 * Project Routes
 * Map project routes to it's appropriate Controller & it's Function.
 */
require_once 'Configurations/Routes.php';

// Initialize the router
$router = new Router();

// Add routes to the router from the projectRoutes configuration
foreach ($projectRoutes as $route => $handler) {
    $router->addRoute($route, $handler);
}

// Dispatch the route
$router->dispatch();
