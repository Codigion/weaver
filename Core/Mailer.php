<?php

/**
 * Weaver Framework - Mailer Class
 *
 * This class provides functionality for adding emails to the mail broker and sending them.
 * It also handles the creation of the mail_broker table if it doesn't exist.
 * 
 * NOTE: send() function is dependent on Libraries/Mail.py
 */
class Mailer
{
    private $db;

    /**
     * Constructor
     *
     * Initializes the Mailer object and creates the mail_broker table if it doesn't exist.
     */
    public function __construct()
    {
        $this->db = MySQL::getInstance();

        // Create the mail_broker table if it doesn't exist
        $this->initialize();
    }

    /**
     * Add Email to Mail Broker
     *
     * Adds an email to the mail broker for later sending.
     *
     * @param string $email   The recipient's email address.
     * @param string $subject The subject of the email.
     * @param string $message The email message content.
     * @return bool           True if the email was added successfully, false otherwise.
     */
    public function add($email, $subject, $message)
    {
        // Validate email, subject, and message to ensure they are safe and properly formatted

        // Add the email to the mail_broker table with appropriate validation and sanitization
        $query = "INSERT INTO mail_broker (email, subject, message, status) VALUES (" . $this->db->escape($email) . ", " . $this->db->escape($subject) . ", " . $this->db->escape($message) . ", '0')";

        try {
            $this->db->query($query);
            return true;
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }

    /**
     * Send All Pending Emails
     *
     * Retrieves all pending emails from the mail_broker table and sends them.
     */
    public function send()
    {
        try {
            // Retrieve all pending emails from the mail_broker table
            $query = "SELECT id, email, subject, message FROM mail_broker WHERE status = '0'";
            $result = $this->db->query($query);
            $emails = $this->db->result($result);

            // Loop through pending emails and send them using an email-sending script (e.g., Python)
            foreach ($emails as $email) {
                // Escape and validate email, subject, and message before using in the shell command
                $escapedEmail = escapeshellarg($email->email);
                $escapedSubject = escapeshellarg($email->subject);
                $escapedMessage = escapeshellarg($email->message);

                // Construct the command to execute the email-sending script securely
                $command = "python3 Libraries/Mail.py $escapedEmail $escapedSubject $escapedMessage";

                // Execute the email-sending script
                shell_exec($command);

                // Update the status of the sent email in the database
                $query = "UPDATE mail_broker SET status = '1' WHERE id = " . $this->db->escape($email->id);
                $this->db->query($query);
            }
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }


    /**
     * Initialize - Create Mail Broker Table
     *
     * Creates the mail_broker table in the database if it doesn't already exist.
     * Ensures that the table structure is secure.
     */
    private function initialize()
    {
        // SQL statement to create the mail_broker table
        $query = "
            CREATE TABLE IF NOT EXISTS mail_broker (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                subject VARCHAR(255) NOT NULL,
                message LONGTEXT NOT NULL,
                status ENUM('0','1') DEFAULT '0',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";

        try {
            $this->db->query($query);
        } catch (Exception_ $e) {
            System::displayErrorPage($e);
        }
    }
}
