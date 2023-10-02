<?php

/**
 * Weaver Framework - Response Class
 *
 * This class provides common functionality for handling responses, including JSON and CSV output.
 */

class Response
{
    /**
     * Send a JSON response.
     *
     * This method sends a JSON response with the provided data and sets the appropriate headers.
     *
     * @param array $data The data to be encoded as JSON.
     * @return void
     */
    public static function json($data)
    {
        try {
            header('Content-Type: application/json');
            echo json_encode($data);
            exit; // Terminate script execution after sending the response
        } catch (Exception $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Generate and download a CSV file.
     *
     * This method takes an array of data and converts it into a CSV file that the user can download.
     *
     * @param array  $data     The data to be converted to CSV format.
     *                        Data format:
     *                        [
     *                            ["Name", "Age", "Email"],
     *                            ["John Doe", 30, "john@example.com"],
     *                            ["Jane Smith", 25, "jane@example.com"],
     *                        ]
     * @param string $filename (Optional) The name of the downloaded CSV file (e.g., "example.csv").
     *                        If not provided, the default filename will be the current date in "YYYY-MM-DD.csv" format.
     *
     * @return void
     */
    public function csv($data, $filename = null)
    {
        try {
            if ($filename === null) {
                $filename = date('Y-m-d H:i:s') . '.csv';
            }

            // Set the HTTP headers to force the browser to download the file
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            // Create a file handle for output
            $output = fopen('php://output', 'w');

            // Write the CSV header row (optional, depending on your data)
            // For example, if your data is an associative array, you can use the keys as headers
            if (!empty($data)) {
                fputcsv($output, array_keys($data[0]));
            }

            // Write the data to the CSV file
            foreach ($data as $row) {
                fputcsv($output, $row);
            }

            // Close the file handle
            fclose($output);

            // Exit to prevent any additional output
            exit();
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }
}
