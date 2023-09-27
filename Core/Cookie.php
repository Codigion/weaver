<?php

/**
 * Cookie Class
 *
 * This class provides methods for setting, getting, deleting, and destroying cookies in PHP.
 */
class Cookie
{
    /**
     * Set Cookie
     *
     * Set a cookie with the specified name, value, and optional parameters.
     *
     * @param string $name     The name of the cookie.
     * @param mixed  $value    The value to store in the cookie.
     * @param int    $expires  The expiration time of the cookie in seconds (default is 0).
     * @param string $path     The path on the server where the cookie will be available (default is '/').
     * @param string $domain   The domain where the cookie is valid (default is empty).
     * @param bool   $secure   Indicates if the cookie should only be sent over secure connections (default is true).
     * @param bool   $httponly Indicates if the cookie should be accessible only through HTTP (default is true).
     *
     * @return bool True on success, false on failure.
     */
    public static function set($name, $value, $expires = 0, $path = '/', $domain = '', $secure = true, $httponly = true)
    {
        return setcookie($name, $value, time() + $expires, $path, $domain, $secure, $httponly);
    }

    /**
     * Get Cookie
     *
     * Retrieve the value of a cookie with the specified name.
     *
     * @param string $name The name of the cookie to retrieve.
     *
     * @return mixed|null The value of the cookie if it exists, or null if the cookie is not set.
     */
    public static function get($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    /**
     * Delete Cookie
     *
     * Delete a cookie with the specified name by setting its expiration time to the past.
     *
     * @param string $name The name of the cookie to delete.
     *
     * @return bool True on success, false on failure.
     */
    public static function unset($name)
    {
        return self::set($name, '', -1);
    }

    /**
     * Destroy All Cookies
     *
     * Delete all cookies by iterating through them and setting their expiration time to the past.
     *
     * @return void
     */
    public static function destroy()
    {
        foreach ($_COOKIE as $name => $value) {
            self::unset($name);
        }
    }

    /**
     * Check if a Cookie Exists
     *
     * This function checks whether a cookie with the specified name exists.
     *
     * @param string $name The name of the cookie to check.
     *
     * @return bool True if the cookie exists, false otherwise.
     */
    public static function cookieExists($name)
    {
        return isset($_COOKIE[$name]);
    }
}
