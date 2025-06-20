<?php

return [
  "GET" => [
    "/home" => "HomeController@index",
    "/register" => "AuthController@create",
    "/login" => "AuthController@login",
    "/dashboard" => "DashboardController@index",
    '/comics/create' => 'ComicsController@create',
    '/comics/edit' => 'ComicsController@edit',
    '/search' => 'ComicsController@index',
    '/comics' => 'ComicsController@info',
    '/read' => 'ComicsController@read',
    // -- chapter management
    '/chapters' => 'ChaptersController@index',
    '/chapters/create' => 'ChaptersController@create',
    '/chapters/edit' => 'ChaptersController@edit',
  ],

  "POST" => [
    '/register' => "AuthController@store",
    '/logout' => "AuthController@logout",
    '/login' => "AuthController@authenticate",
    '/comics' => "ComicsController@store",
    '/comics/update' => "ComicsController@update",
    '/comics/delete' => "ComicsController@delete",
    '/chapters' => "ChaptersController@store",
    '/chapters/update' => "ChaptersController@update",
  ]
];
