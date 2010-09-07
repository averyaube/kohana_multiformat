<?php defined('SYSPATH') or die('No direct script access.');

class Multiformat_Extensions {

    protected static $_extensions = array(
        'php',
        'json',
        'yml',
        'ini',
    );

    public static function add($ext)
    {
        if( ! in_array($ext, self::$_extensions))
        {
           self::$_extensions[] = $ext;
        }
    }

    public static function extensions()
    {
        return self::$_extensions;
    }

}