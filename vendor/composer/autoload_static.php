<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit013ed98ce681d59d5ad3a10bd58e0477
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CavinKim\\LaravelTerminalLogger\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CavinKim\\LaravelTerminalLogger\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit013ed98ce681d59d5ad3a10bd58e0477::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit013ed98ce681d59d5ad3a10bd58e0477::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit013ed98ce681d59d5ad3a10bd58e0477::$classMap;

        }, null, ClassLoader::class);
    }
}
