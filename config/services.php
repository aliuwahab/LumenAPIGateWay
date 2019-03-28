<?php
/**
 * Created by PhpStorm.
 * User: aliuwahab
 * Date: 28/03/2019
 * Time: 12:05 PM
 */


return [
    'authors' => [
        'base_uri' => env('AUTHORS_SERVICE_BASE_URL'),
        'secret' => env('AUTHORS_SERVICE_SECRET'),
    ],

    'books' => [
        'base_uri' => env('BOOKS_SERVICE_BASE_URL'),
        'secret' => env('BOOKS_SERVICE_SECRET'),
    ]
];
