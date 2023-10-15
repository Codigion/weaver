<?php
/**
 * Weaver Framework - Session Management Class
 *
 * This class provides session management functionalities for starting, setting, getting, unsetting,
 * and destroying sessions.
 */

class Session
{
    /**
     * Set a session variable.
     *
     * @param string $key   The session variable name.
     * @param mixed  $value The value to store in the session.
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get the value of a session variable.
     *
     * @param string $key     The session variable name.
     * @param mixed  $default The default value to return if the session variable is not set.
     *
     * @return mixed The value of the session variable or the default value.
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Unset a session variable.
     *
     * @param string $key The session variable name.
     */
    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy the current session.
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * Check is session exists.
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }
}
