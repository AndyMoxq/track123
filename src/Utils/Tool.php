<?php

namespace Track123\OpenApi\Utils;


use backend\process\Aes;

class Tool
{
    /**
     * The cache of studly-cased words.
     * @var array
     */
    protected static $studlyCache = [];

    /**
     * Convert a value to studly caps case.
     * @param string $value
     * @return string
     */
    public static function studly($value)
    {
        $key = $value;
        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }

    /**
     * @param $jsonString
     * @return mixed
     */
    public static function parseJSON($jsonString)
    {
        return json_decode($jsonString, true);
    }

    /**
     * @return false|string
     */
    public static function getDateUTCString()
    {
        return gmdate('D, d M Y H:i:s T');
    }

    /**
     * @param $real
     * @param string $default
     * @return string
     */
    public static function defaultString($real, $default = '')
    {
        return null === $real ? $default : $real;
    }

    /**
     * @param $real
     * @param int $default
     * @return int
     */
    public static function defaultNumber($real, $default = 0)
    {
        if (null === $real)
            return $default;
        return (int)$real;
    }

    /**
     * @param $millisecond
     */
    public static function sleep($millisecond)
    {
        usleep($millisecond * 1000);
    }

    /**
     * @param array $value
     * @param string $splitStr
     * @return string
     */
    public static function toStr(array $value, $splitStr = ',')
    {
        return implode($splitStr, $value);
    }

    /**
     * 数组转字符串
     * @param $paramter
     * @return string
     */
    public static function arrayToString($paramter)
    {
        ksort($paramter);
        $signData = [];
        foreach ($paramter as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            } elseif (is_null($value) || trim($value) === "") {
                continue;
            }
            $signData[] = "{$key}={$value}";
        }
        return implode('&', $signData);
    }
}
