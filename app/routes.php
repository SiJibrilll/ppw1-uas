<?php

return [
  "GET" => [
    "/home" => "HomeController@index",
    "/register" => "AuthController@create",
    "/login" => "AuthController@login",
    "/dashboard" => "DashboardController@index"
  ],

  "POST" => [
    '/register' => "AuthController@store",
    '/login' => "AuthController@authenticate"
  ]
];
