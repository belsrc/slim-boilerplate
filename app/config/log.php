<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Log File Name Format
    |--------------------------------------------------------------------------
    |
    | The file name format is parsed with 'date()'
    | http://php.net/manual/en/function.date.php
    */
    'log_name_format' => 'm_d_Y',

    /*
    |--------------------------------------------------------------------------
    | Log File Extension
    |--------------------------------------------------------------------------
    */
    'log_extension' => 'log',

    /*
    |--------------------------------------------------------------------------
    | Log Message Format
    |--------------------------------------------------------------------------
    |
    | The available tokens are
    | %label%    Replaced with the log message level (e.g. FATAL, ERROR, WARN).
    | %date%     Replaced with a ISO8601 date string for current timezone.
    | %message%  Replaced with the log message, coerced to a string.
    */
    'log_message_format' => '%label% - %date% - %message%',
);
