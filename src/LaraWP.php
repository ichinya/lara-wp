<?php

namespace Ichinya\LaraWP;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaraWP
{
    private array $wp_config = [];

    private ?Connection $connection = null;

    private static ?LaraWP $instance = null;

    public function __construct($wp_config_filepath = null)
    {
        if (! is_null($wp_config_filepath)) {
            $wp_config_filepath = public_path('wp-config.php');
        }
        $file = public_path('wp-config.php');

        if (! is_file($file)) {
            exit('NO FILE: '.$file);
        }

        $wp_config = file_get_contents($file);
        $re = '/define\(.*\'(\w+)\',(.*)\);/m';
        preg_match_all($re, $wp_config, $matches, PREG_SET_ORDER, 0);

        foreach ($matches as $match) {
            $this->wp_config[$match[1]] = trim(Str::replace(['\''], '', $match[2]));
        }
    }

    public static function getInstanse(): static
    {
        if (! isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getConfig($key, $default = null)
    {
        return $this->wp_config[$key] ?? $default;
    }

    public function db(): \Illuminate\Database\Connection
    {
        if (! isset($this->connection)) {
            Config::set('database.connections.wordpress', [
                'driver' => 'mysql',
                'host' => $this->getConfig('DB_HOST'),
                'database' => $this->getConfig('DB_NAME'),
                'username' => $this->getConfig('DB_USER'),
                'password' => $this->getConfig('DB_PASSWORD'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => 'wp_',
                'strict' => false,
                'engine' => null,
            ]);
            $this->connection = DB::connection('wordpress');
        }

        return $this->connection;
    }
}
