<?php

namespace App\Lib;

class Info
{

    public static function getProjectRoot()
    {
        $dir = dirname(dirname(__DIR__));
        return realpath($dir);
    }

    public static function getPublicRoot()
    {
        return self::getProjectRoot() . '/public';
    }

    public static function getMediaRoot()
    {
        return self::getPublicRoot() . '/media';
    }

}
