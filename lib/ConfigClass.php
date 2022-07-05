<?php

# Clase para leer ficheros de configuración alojados en el directorio config y que devuelven un array
#
#  return array ( );
#

class ConfigClass
{

  public static $items = [];

  public static function load( $filepath)
  {
    static::$items = include(  dirname( dirname(__FILE__)).'/config/' . $filepath . '.php');
  }

  public static function get($key = null)
  {
    $input = explode('.', $key);
    $filepath = $input[0];
    unset($input[0]);
    $key = implode('.', $input);

    static::load($filepath);

    if ( ! empty($key))
    {
        return static::$items[ $key];
    }

    return static::$items;
  }

}