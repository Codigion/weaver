<?php

/**
 * MyController Controller
 *
 * This is a demo controller to demonstrate Framework usage.
 */
class MyController
{
    /**
     * setCookie Method
     *
     * This method sets a cookie with the provided name and value, and performs validation
     * to ensure that both the cookie name and value are not empty.
     *
     * @throws Exception If validation fails or if there's an issue setting the cookie.
     *
     * @return void
     */
    public function setCookie()
    {
        try {
            // Retrieve the cookie name and value from the POST request
            $cookieName = Request::post('cookieName');
            $cookieValue = Request::post('cookieValue');

            // Validate that both the cookie name and value are not empty
            if (Validation::isEmpty($cookieName) || Validation::isEmpty($cookieValue)) {
                throw new Exception('Validation Error: Enter correct values!');
            }

            // Set the cookie using your Cookie class
            if (!Cookie::set($cookieName, $cookieValue, 3600, '/', '', false, false)) {
                throw new Exception('Failed to set the cookie.');
            }

            // Send a JSON response indicating that the cookie was set successfully
            Response::json(array(
                'err' => false,
                'msg' => 'Cookie is set!'
            ));
        } catch (Exception $e) {
            Response::json(array(
                'err' => true,
                'msg' => $e->getMessage()
            ));
        }
    }

    /**
     * unsetCookie Method
     *
     * This method unsets a cookie with the provided name, and performs validation
     * to ensure that the cookie name is not empty.
     *
     * @throws Exception If validation fails or if there's an issue unsetting the cookie.
     *
     * @return void
     */
    public function unsetCookie()
    {
        try {
            // Retrieve the cookie name to delete from the POST request
            $cookieToDelete = Request::post('cookieToDelete');

            // Validate that the cookie name to delete is not empty
            if (Validation::isEmpty($cookieToDelete)) {
                throw new Exception('Validation Error: Enter correct values!');
            }

            // Check if cookie exists
            if (!Cookie::cookieExists($cookieToDelete)) {
                throw new Exception('Validation Error: Cookie not found!');
            }

            // Unset the cookie using your Cookie class
            if (!Cookie::unset($cookieToDelete)) {
                throw new Exception('Failed to unset the cookie.');
            }

            // Send a JSON response indicating that the cookie was deleted successfully
            Response::json(array(
                'err' => false,
                'msg' => 'Cookie is deleted!'
            ));
        } catch (Exception $e) {
            Response::json(array(
                'err' => true,
                'msg' => $e->getMessage()
            ));
        }
    }

    // Other methods with exception handling...

    /**
     * email Method
     *
     * This method handles sending an email.
     *
     * @throws Exception If email validation fails or if there's an issue sending the email.
     *
     * @return void
     */
    public function email()
    {
        try {
            // Retrieve the email address from the POST request
            $email = Request::post('email');

            // Validate the email address
            if (!Validation::isEmail($email)) {
                throw new Exception('Validation Error: Email is not valid!');
            }

            // Create a Mailer instance and send a test email
            $mailer = new Mailer();
            $mailer->add($email, 'Testing', 'This is a test email.');
            $mailer->send();

            // Send a JSON response indicating that the email was sent successfully
            Response::json(array(
                'err' => false,
                'msg' => 'Email sent!'
            ));
        } catch (Exception $e) {
            Response::json(array(
                'err' => true,
                'msg' => $e->getMessage()
            ));
        }
    }

    /**
     * save Method
     *
     * This method handles saving data.
     *
     * @throws Exception If validation fails or if there's an issue saving data.
     *
     * @return void
     */
    public function save()
    {
        try {
            // Validate the 'demo' input
            if (!Validation::isName(Request::post('demo'))) {
                throw new Exception('Validation Error: Name is not valid!');
            }

            // Attempt to save data using MyModel
            $result = System::loadModel('MyModel')->save();

            if ($result) {
                Response::json(array(
                    'err' => false,
                    'msg' => 'Data saved successfully! (Data: ' . $result[0]->demo . ')'
                ));
            } else {
                throw new Exception('Sorry, data could not be saved.');
            }
        } catch (Exception $e) {
            Response::json(array(
                'err' => true,
                'msg' => $e->getMessage()
            ));
        }
    }

    /**
     * upload Method
     *
     * This method handles file uploads.
     *
     * @throws Exception If there's an issue with file upload.
     *
     * @return void
     */
    public function upload()
    {
        try {
            // Upload the file and get the upload response
            $uploadResponse = File::uploadFile(Request::fileHandle('demo_file'), 'Assets/Uploads', array('png'));

            // Respond with the upload response
            Response::json($uploadResponse);
        } catch (Exception $e) {
            Response::json(array(
                'err' => true,
                'msg' => $e->getMessage()
            ));
        }
    }
}
