<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit681b32b27be7c8878b36ae0ad7025f74
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit681b32b27be7c8878b36ae0ad7025f74::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit681b32b27be7c8878b36ae0ad7025f74::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit681b32b27be7c8878b36ae0ad7025f74::$classMap;

        }, null, ClassLoader::class);
    }
}
