<?php

namespace Track123\OpenApi;


use Track123\OpenApi\Contracts\Config;
use Track123\OpenApi\Utils\Tool;
/**
 * Class Factory.
 *
 * @method static \Track123\OpenApi\System\System  system($name, Config $config = null)
 */
class Track123
{
    /**
     * @param $name
     * @return mixed
     */
    public static function make($name, Config $config = null)
    {
        $client = sprintf('\\Track123\\OpenApi\\%s\\%s', Tool::studly($name), Tool::studly($name));

        if (!class_exists($client)) {
            throw new \InvalidArgumentException("Module [$name] not found: class [$client] does not exist.");
        }

        return new $client($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
