<?php
/**
 * Meta Class
 *
 * The Meta class provides functions for retrieving meta data for web pages.
 */
class MetaData
{
    /**
     * Get meta data for a specific page.
     *
     * This function returns an array containing meta data (title, description, keywords) for the given page.
     *
     * @param string|null $page The page for which to retrieve meta data. Defaults to the current request URI.
     * @return array An array containing meta data for the specified page.
     */
    public static function get($page = null)
    {
        $metaData = array();

        // Use the current request URI if $page is not specified
        if ($page === null) {
            // Get the URL path
            $page = isset($_GET['url']) ? $_GET['url'] : '/';

            // Remove trailing slashes
            if ($page !== '/') {
                $page = rtrim($page, '/');
            }
        }

        switch ($page) {
            // Example Case:
            // Add cases for specific pages here
            // case '/about':
            //     // Meta data for the "About" page
            //     $metaData['title'] = 'About Us - ' . PROJECT_NAME;
            //     $metaData['description'] = 'Learn more about our company and our mission.';
            //     $metaData['keywords'] = 'about us, company, mission, values';
            //     break;

            default:
                // Use default meta data for unspecified pages
                $metaData['title'] = PROJECT_NAME;
                $metaData['description'] = PROJECT_NAME;
                $metaData['keywords'] = PROJECT_NAME;
                break;
        }

        return $metaData;
    }
}
