<?php
/**
 * MyModel Model
 *
 * This model demonstrates the usage of the Model class.
 */
class MyModel
{
    private $db;

    /**
     * Constructor
     *
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = MySQL::getInstance();
    }

    /**
     * Save Method
     *
     * This method creates the 'demo' table if it doesn't exist,
     * inserts a new record with the provided 'demo' value,
     * and returns the inserted 'demo' value.
     *
     * @throws Exception If there's an issue with database queries or if validation fails.
     *
     * @return mixed The inserted 'demo' value or false on failure.
     */
    public function save()
    {
        try {
            // Create the 'demo' table if it doesn't exist
            $this->db->query("
            CREATE TABLE IF NOT EXISTS demo (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                demo TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ");

            // Validate the 'demo' input
            $demoValue = Request::post('demo');
            if (empty($demoValue)) {
                throw new Exception('Validation Error: Demo value is empty.');
            }

            // Insert a new record with the provided 'demo' value
            $this->db->query("INSERT INTO demo (demo) VALUES (" . $this->db->escape($demoValue) . ")");

            // Check if the insertion was successful
            if ($this->db->affectedRows() === 0) {
                throw new Exception('Failed to insert data.');
            }

            // Return the inserted 'demo' value
            return $this->db->result($this->db->query("SELECT demo FROM demo WHERE id = '" . $this->db->insertID() . "'"));
        } catch (Exception $e) {
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
}
