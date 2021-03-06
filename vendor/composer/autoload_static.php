<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit63f8c4dafd8fd739560a88bfdcd3ee21
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit63f8c4dafd8fd739560a88bfdcd3ee21::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit63f8c4dafd8fd739560a88bfdcd3ee21::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
