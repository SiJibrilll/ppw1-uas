<?php

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([self::class, 'load']);
    }

    public static function load(string $class): void
    {
        // Base directory of the app
        $baseDir = __DIR__ . '/';

        
        $file = $baseDir . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}
