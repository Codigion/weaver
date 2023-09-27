<?= TimeDate::formatDatetime(date('2023-09-04')); ?>

<h1>Howdy, <?= Session::get('user'); ?>!</h1>

<p>Page URL: <?= Generic::baseURL(); ?></p>

<br />

<h3>Demonstrations</h3>

<!-- MySQL Connection -->
<?php
class MySQLDemo
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
     * Check the database connection status.
     *
     * @return bool True if connected, false otherwise.
     */
    public function checkConnection()
    {
        return $this->db !== null;
    }
}

$db = new MySQLDemo();
$isConnected = $db->checkConnection();
?>
<!-- ./MySQL Connection -->

<!-- Loading Effect Spinner -->
<div id="loading" class="loading-spinner"></div>

<!-- Server Response -->
<div id="response" style="margin-bottom: 10px;">
    MySQL is <?php echo $isConnected ? 'connected.' : 'not connected.'; ?>
</div>

<form action="#!" id="testForm">

    <!-- Save -->
    <input type="text" name="demo" value="Demo" />
    <button id="saveBtn">Save</button>
    <script>
        // Bind the 'validateBtn' click event to an AJAX request
        new HTTP().bindAjax({
            btnID: 'saveBtn',
            formID: 'testForm',
            extraParameters: '',
            controllerRoute: 'Save',
            callbackFunction: function(response) {
                // Handle the AJAX response here
                console.log(response);
            },
            responseID: 'response',
            loadingID: 'loading'
        });
    </script>
    <!-- ./Save -->

    <br /><br />

    <!-- Upload -->
    <input type="file" name="demo_file" />
    <button id="uploadBtn">Upload PNG File</button>
    <script>
        // Bind the 'uploadBtn' click event to an AJAX request
        new HTTP().bindAjax({
            btnID: 'uploadBtn',
            formID: 'testForm',
            extraParameters: '',
            controllerRoute: 'Upload',
            callbackFunction: function(response) {
                // Handle the AJAX response here
                console.log(response);
            },
            responseID: 'response',
            loadingID: 'loading'
        });
    </script>
    <!-- ./Upload -->

    <br /><br />

    <!-- Mailer -->
    <input type="email" name="email" value="contact@codigion.com" />
    <button id="emailBtn">Send Mail</button>
    <script>
        // Bind the 'emailBtn' click event to an AJAX request
        new HTTP().bindAjax({
            btnID: 'emailBtn',
            formID: 'testForm',
            extraParameters: '',
            controllerRoute: 'Email',
            callbackFunction: function(response) {
                // Handle the AJAX response here
                console.log(response);
            },
            responseID: 'response',
            loadingID: 'loading'
        });
    </script>
    <!-- ./Mailer -->

</form>

<br /><br />

<!-- Cookie -->
<!-- Set Cookie Form -->
<form action="#!" id="setCookieForm" method="post">
    <input type="text" name="cookieName" id="cookieName" placeholder="Cookie Name" value="cookie_name">
    <input type="text" name="cookieValue" id="cookieValue" placeholder="Cookie Value" value="cookie_value">
    <button type="submit" id="setCookieBtn">Set Cookie</button>
</form>
<script>
    // Bind the 'uploadBtn' click event to an AJAX request
    new HTTP().bindAjax({
        btnID: 'setCookieBtn',
        formID: 'setCookieForm',
        extraParameters: '',
        controllerRoute: 'SetCookie',
        callbackFunction: function(response) {
            // Handle the AJAX response here
            console.log(response);
        },
        responseID: 'response',
        loadingID: 'loading'
    });
</script>
<!-- ./Set Cookie Form -->

<br />

<!-- Unset Cookie Form -->
<form action="#!" id="unsetCookieForm" method="post">
    <input type="text" name="cookieToDelete" id="cookieToDelete" placeholder="Cookie Name" value="cookie_name">
    <button type="submit" id="unsetCookieBtn">Delete Cookie</button>
</form>
<script>
    // Bind the 'uploadBtn' click event to an AJAX request
    new HTTP().bindAjax({
        btnID: 'unsetCookieBtn',
        formID: 'unsetCookieForm',
        extraParameters: '',
        controllerRoute: 'UnsetCookie',
        callbackFunction: function(response) {
            // Handle the AJAX response here
            console.log(response);
        },
        responseID: 'response',
        loadingID: 'loading'
    });
</script>
<!-- ./Unset Cookie Form -->
<!-- ./Cookie -->