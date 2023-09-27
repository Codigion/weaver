<?php

/**
 * Validation Class
 *
 * The Validation class provides functions for common data validation tasks.
 */
class Validation
{
    /**
     * isEmpty Validation Function
     *
     * This function checks if a given value is empty. An empty value is considered:
     * - An empty string ('')
     * - A string containing only whitespace characters (e.g., ' ', '\t', '\n')
     * - null
     * - An empty array ([])
     *
     * @param mixed $value The value to validate.
     *
     * @return bool True if the value is empty, false otherwise.
     */
    public static function isEmpty($value)
    {
        // Check if the value is null or an empty string
        if ($value === null || $value === '') {
            return true;
        }

        // Check if the value is a string containing only whitespace characters
        if (is_string($value) && trim($value) === '') {
            return true;
        }

        // Check if the value is an empty array
        if (is_array($value) && count($value) === 0) {
            return true;
        }

        // If none of the above conditions are met, the value is not empty
        return false;
    }


    /**
     * Validate a name.
     *
     * @param string $name The name to validate.
     * @param int $minLength (Optional) Minimum name length.
     * @param int $maxLength (Optional) Maximum name length.
     * @return bool True if the name is valid; otherwise, false.
     */
    public static function isName($name, $minLength = 2, $maxLength = 50)
    {
        $name = trim($name);
        $pattern = '/^[a-zA-Z\- ]{' . $minLength . ',' . $maxLength . '}$/';

        return (bool) preg_match($pattern, $name);
    }

    /**
     * Validate an email address.
     *
     * @param string $email The email address to validate.
     * @return bool True if the email is valid; otherwise, false.
     */
    public static function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate a phone number.
     *
     * @param string $phoneNumber The phone number to validate.
     * @return bool True if the phone number is valid; otherwise, false.
     */
    public static function isPhoneNumber($phoneNumber)
    {
        // Replace non-numeric characters and check length
        $cleanedNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        return (strlen($cleanedNumber) >= 7 && strlen($cleanedNumber) <= 15);
    }

    /**
     * Validate a date.
     *
     * @param string $date The date to validate.
     * @param string $format (Optional) Date format to check against.
     * @return bool True if the date is valid; otherwise, false.
     */
    public static function isDate($date, $format = 'Y-m-d')
    {
        $parsedDate = date_parse_from_format($format, $date);
        return ($parsedDate['error_count'] === 0 && checkdate($parsedDate['month'], $parsedDate['day'], $parsedDate['year']));
    }

    /**
     * Validate a URL.
     *
     * @param string $url The URL to validate.
     * @return bool True if the URL is valid; otherwise, false.
     */
    public static function isUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validate password strength.
     *
     * @param string $password The password to validate.
     * @return bool True if the password is strong; otherwise, false.
     */
    public static function isStrongPassword($password)
    {
        // Check if the password is at least 8 characters long
        if (strlen($password) < 8) {
            return false;
        }

        // Check if the password contains at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Check if the password contains at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Check if the password contains at least one digit
        if (!preg_match('/\d/', $password)) {
            return false;
        }

        // Check if the password contains at least one special character
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            return false;
        }

        // All validation checks passed, the password is strong
        return true;
    }

    /**
     * Validate a numeric value.
     *
     * @param mixed $number The value to validate.
     * @return bool True if the value is numeric; otherwise, false.
     */
    public static function isNumeric($number)
    {
        return is_numeric($number);
    }

    /**
     * Validate file extension.
     *
     * @param string $fileName The name of the file to validate.
     * @param array $allowedExtensions An array of allowed file extensions.
     * @return bool True if the file extension is valid; otherwise, false.
     */
    public static function isFileExtension($fileName, $allowedExtensions)
    {
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        return in_array($fileExtension, $allowedExtensions);
    }

    /**
     * Custom validation function.
     *
     * @param mixed $value The value to validate.
     * @param callable $customFunction The custom validation function.
     * @return bool True if the custom validation passes; otherwise, false.
     */
    public static function isCustom($value, $customFunction)
    {
        return call_user_func($customFunction, $value);
    }
}
