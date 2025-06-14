<?php

return [
  "GET" => [
    "/home" => "HomeController@index",
    "/register" => "AuthController@create",
    "/login" => "AuthController@login",
    "/dashboard" => "DashboardController@index",
    '/comics/create' => 'ComicsController@create',
    '/comics/edit' => 'ComicsController@edit',
    '/search' => 'ComicsController@index'
  ],

  "POST" => [
    '/register' => "AuthController@store",
    '/logout' => "AuthController@logout",
    '/login' => "AuthController@authenticate",
    '/comics' => "ComicsController@store"
  ]
];
