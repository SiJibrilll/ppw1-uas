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
  ],

  "POST" => [
    '/register' => "AuthController@store",
    '/logout' => "AuthController@logout",
    '/login' => "AuthController@authenticate",
    '/comics' => "ComicsController@store",
    '/comics/update' => "ComicsController@update",
    '/comics/delete' => "ComicsController@delete",
  ]
];
