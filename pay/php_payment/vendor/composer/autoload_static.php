<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0a13724b0c8792b86fecedd88c3ea93b
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SquareConnect\\' => 14,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SquareConnect\\' => 
        array (
            0 => __DIR__ . '/..' . '/square/connect/lib',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0a13724b0c8792b86fecedd88c3ea93b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0a13724b0c8792b86fecedd88c3ea93b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
