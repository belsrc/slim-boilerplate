<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Database Connection Information
    |--------------------------------------------------------------------------
    |
    | The database connection information. This uses the illuminate/database package
    | so you can find more information here.
    |\ http://laravel.com/docs/database   -> Select '4.1' at the top
    */
    'connections' => array(

        'development' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => '',
            'username'  => '',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

        'production' => array(
            'driver'    => 'mysql',
            'host'      => '',
            'database'  => '',
            'username'  => '',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    ),
);
