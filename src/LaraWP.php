<?php

namespace Ichinya\LaraWP;

use Ichinya\LaraWP\Exceptions\NoConfigException;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaraWP
{
    private array $wpConfig = [];

    private ?Connection $connection = null;

    private static ?self $instance = null;

    /**
     * Constructor for initializing the wp_config object.
     *
     * @param string|null $wpConfigFilePath The file path to the wp-config.php file
     *
     * @throws NoConfigException When the wp_config file is not found
     */
    public function __construct(?string $wpConfigFilePath = null)
    {
        // Set default file path if not provided
        $wpConfigFilePath = $wpConfigFilePath ?? public_path('wp-config.php');

        // Throw exception if file is not found
        if (!file_exists($wpConfigFilePath)) {
            report(new NoConfigException('NO FILE: ' . $wpConfigFilePath));
            return;
        }

        // Read wp-config file and extract define statements
        $wpConfig = file_get_contents($wpConfigFilePath);

        $re = '/\$(\w+)\s*=\s*(.*);/m';
        preg_match_all($re, $wpConfig, $matches, PREG_SET_ORDER, 0);
        foreach ($matches as $match) {
            $this->wpConfig[$match[1]] = trim(Str::replace(['\''], '', $match[2]));
        }

        $re = '/define\(.*\'(\w+)\',(.*)\);/m';
        preg_match_all($re, $wpConfig, $matches, PREG_SET_ORDER, 0);

        // Map define statements to wpConfig array
        foreach ($matches as $match) {
            $this->wpConfig[$match[1]] = trim(Str::replace(['\''], '', $match[2]));
        }

        data_fill($this->wpConfig, 'table_prefix', 'wp_');

        if ($this->getConfig('DB_CHARSET') == 'utf8mb4' && empty($this->getConfig('DB_COLLATE'))) {
            $this->wpConfig['DB_COLLATE'] = 'utf8mb4_unicode_ci';
        }

    }

    /**
     * Get the instance of the class.
     */
    public static function getInstance(): self
    {
        return self::$instance ??= new self;
    }

    /**
     * Get a configuration value from the wp-config.
     *
     * @param string $key The key to retrieve
     * @param mixed $default The default value if the key is not found
     */
    public function getConfig(string $key, mixed $default = null): mixed
    {
        return $this->wpConfig[$key] ?? $default;
    }

    /**
     * Get the database connection or create it.
     */
    public function db(): Connection
    {
        // Set up the database configuration if it doesn't exist
        if (!isset($this->connection)) {
            Config::set('database.connections.wordpress', [
                'driver' => 'mysql',
                'host' => $this->getConfig('DB_HOST'),
                'database' => $this->getConfig('DB_NAME'),
                'username' => $this->getConfig('DB_USER'),
                'password' => $this->getConfig('DB_PASSWORD'),
                'charset' => $this->getConfig('DB_CHARSET', 'utf8'),
                'collation' => $this->getConfig('DB_COLLATE', 'utf8_unicode_ci'),
                'prefix' => $this->getConfig('table_prefix', 'wp_'),
                'strict' => false,
                'engine' => null,
            ]);
        }

        // Return the database connection
        return $this->connection ??= DB::connection('wordpress');
    }
}
