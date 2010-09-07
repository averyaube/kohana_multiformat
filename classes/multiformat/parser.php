<?php defined('SYSPATH') or die('No direct script access.');

class Multiformat_Parser {

    static function parse_file($file, $ext=NULL)
    {
        switch($ext)
        {
            case 'json':
                return self::json(file_get_contents($file));
            case 'ini':
                return self::ini(file_get_contents($file));
            case 'yml':
                return self::yaml(file_get_contents($file));
            default:
                return Kohana::load($file);
        }
    }

    static function json($data)
    {
        return (array) json_decode($data);
    }

    static function ini($data)
    {
        return parse_ini_string($data);
    }

    static function yaml($data)
    {
        require_once Kohana::find_file('vendor', 'spyc/spyc');
        return Spyc::YAMLLoadString($data);
    }

}
