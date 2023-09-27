<?php

/**
 * Weaver Framework - Project Routes Configuration
 *
 * This file defines all the project routes for the Weaver Framework.
 *
 */

// Define the project routes
$projectRoutes = array(
    /* Portal Routes */
    '/' => 'Portal@Index',

    
    /* Controller Routes */
    //Demonstrational Routes
    'Save' => 'MyController@save',
    'Upload' => 'MyController@upload',
    'Email' => 'MyController@email',
    'SetCookie' => 'MyController@setCookie',
    'UnsetCookie' => 'MyController@unsetCookie',


    /* Lab Routes */
    '_' => 'Lab@Index',


    /* System Routes */
    /**
     * Sending Pending Emails from the Mail Broker
     * 
     * To ensure that emails are promptly sent, you can configure a Cron Job to trigger the following route.
     * We recommend scheduling this job to run every 10 seconds.
     * 
     * To set up the CronJob, add the following entries to your crontab file:
     * 
     * ```shell
     *  * * * * * curl [<PROJECT_URL>]/mx
     *  * * * * * sleep 10 ; curl [<PROJECT_URL>]/mx
     *  * * * * * sleep 20 ; curl [<PROJECT_URL>]/mx
     *  * * * * * sleep 30 ; curl [<PROJECT_URL>]/mx
     *  * * * * * sleep 40 ; curl [<PROJECT_URL>]/mx
     *  * * * * * sleep 50 ; curl [<PROJECT_URL>]/mx
     * ```
     * 
     * This CronJob will automatically process and send any pending emails from the Mail Broker,
     * ensuring timely delivery to recipients.
     * 
     */
    'mx' => 'Mailer@send'
);
