<?php
/**
 * Generic Class
 *
 * The Generic class provides various utility functions.
 */
class Generic
{
    /**
     * Generate a random string.
     *
     * @param int $length The length of the random string.
     * @return string The generated random string.
     */
    public static function getRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $charCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charCount - 1)];
        }

        return $randomString;
    }

    /**
     * Generate a random number.
     *
     * @param int $length The length of the random number.
     * @return string The generated random number.
     */
    public static function getRandomNumber($length = 5)
    {
        $characters = '0123456789';
        $randomNumber = '';
        $charCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $characters[rand(0, $charCount - 1)];
        }

        return $randomNumber;
    }

    /**
     * Get the client's IP address.
     *
     * This function detects the client's IP address from various sources, including HTTP headers.
     *
     * @return string The client's IP address.
     */
    public static function userIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * Get the base URL of the current page.
     *
     * @return string The base URL of the current page.
     */
    public static function baseURL()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];

        // Remove the script name from the URL
        $baseUrl = rtrim($protocol . $host, '/') . dirname($script);

        return $baseUrl;
    }
}
