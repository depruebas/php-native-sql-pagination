<?php

  return [

    'database' => [

      'sakila' => [
        'dsn' => 'mysql:host=172.17.0.2;dbname=sakila;charset=utf8mb4',
        'username' => 'root',
        'password' => 'root',
      ],

    ],

    # ruta de logs  de la aplicacion
    'ruta_logs' => [
      'general' =>   dirname( dirname(__FILE__)) . '/logs/',
      'error_log' =>  dirname( dirname(__FILE__)). '/logs/',
    ],


    # 0 - no depuración / 1 - depuración
    'debug' => 1,

    # development or production
    'environment' => 'development',

  ];