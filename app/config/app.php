<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Set Error Reporting
    |--------------------------------------------------------------------------
    |
    | This sets the timezone for this application.
    | http://php.net/manual/en/timezones.php
    */
   'timezone' => 'America/New_York',

   /*
    |--------------------------------------------------------------------------
    | Authenticated Section of the Site
    |--------------------------------------------------------------------------
    |
    | This is an array of URL paths that need authentication. i.e. '/admin'
    */
   'auth_section'  => array(),

   /*
    |--------------------------------------------------------------------------
    | Authentication Cookie Name
    |--------------------------------------------------------------------------
    */
   'auth_cookie'   => '',

   /*
    |--------------------------------------------------------------------------
    | Authentication Failed Redirect
    |--------------------------------------------------------------------------
    */
   'auth_redirect' => '',

    /*
    |--------------------------------------------------------------------------
    | Whether Or Not Logging Is On
    |--------------------------------------------------------------------------
    */
    'has_logging' => true,

    /*
    |--------------------------------------------------------------------------
    | The Debug Error String Format
    |--------------------------------------------------------------------------
    |
    | The string is parsed with 'sprintf()' and the arguments are given in the following order
    | Exception Class Name
    | Exception Message
    | File Name
    | Line Number
    */
    'debug_error_string' => '%s: %s in file %s on line %d',

    /*
    |--------------------------------------------------------------------------
    | The Live Error String Format
    |--------------------------------------------------------------------------
    */
    'live_error_string' => 'A server error occurred. Please check the log files.',
);
