<?php

/**
 * The base home route
 */
$app->get('/', function() use($app) {
    $app->render('home.html');
})->name('home');
