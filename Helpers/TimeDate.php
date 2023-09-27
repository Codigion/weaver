<?php
/**
 * TimeDate Class
 *
 * The TimeDate class provides methods for formatting time and date strings.
 */

class TimeDate
{
    /**
     * Format a time string.
     *
     * @param string $time The time string in HH:MM format.
     * @return string The formatted time string with AM/PM.
     */
    public static function formatTime($time)
    {
        // Get AM/PM from the input time string
        $am_pm = date('A', strtotime($time));

        // Split the time into hours and minutes
        $time = explode(':', $time);

        // Format and return the time string
        return $time[0] . ":" . $time[1] . " " . $am_pm;
    }

    /**
     * Format a date string in "YYYY-MM-DD" format to "DD/MM/YYYY" format.
     *
     * @param string $inputDate The input date in "YYYY-MM-DD" format.
     * @return string The formatted date in "DD/MM/YYYY" format.
     */
    public static function formatDate($inputDate)
    {
        // Create a DateTime object from the input date
        $dateObj = DateTime::createFromFormat('Y-m-d', $inputDate);

        // Check if the conversion was successful
        if ($dateObj) {
            // Format and return the date string
            return $dateObj->format('d/m/Y');
        } else {
            return 'Invalid date';
        }
    }

    /**
     * Format a datetime string.
     *
     * @param string $datetime The datetime string.
     * @return string The formatted datetime string in "D - d M, Y  H:i" format.
     */
    public static function formatDatetime($datetime)
    {
        // Create a DateTime object from the input datetime
        $dateObj = date_create($datetime);

        // Format and return the datetime string
        return date_format($dateObj, 'D - d M, Y  H:i');
    }
}
