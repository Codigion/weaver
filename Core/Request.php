<?php
/**
 * Weaver Framework - Request Class
 *
 * This class provides common functionality for handling inputs like $_POST, $_GET & $_FILES.
 */

class Request
{
    /**
     * Get a value from the GET request.
     *
     * @param string $key     The key of the value to retrieve.
     * @param mixed $default  The default value to return if the key is not found.
     * @return mixed The value from the GET request or the default value if not found.
     */
    public static function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    /**
     * Get a value from the POST request.
     *
     * @param string $key     The key of the value to retrieve.
     * @param mixed $default  The default value to return if the key is not found.
     * @return mixed The value from the POST request or the default value if not found.
     */
    public static function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Get the file handle from the $_FILES superglobal.
     *
     * This method retrieves the file handle associated with the specified key from the $_FILES superglobal array.
     * If the key is not found, it returns the provided default value.
     *
     * @param string $key     The key to look up in the $_FILES array.
     * @param mixed $default  (Optional) The default value to return if the key is not found. Default is null.
     * @return mixed|null The file handle if found, or the default value if not found.
     */
    public static function fileHandle($key, $default = null)
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : $default;
    }
}
