<?php

namespace CavinKim\LaravelTerminalLogger;

class Logger
{
    public static function log(string $type, string $message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        fwrite(STDERR, "\n[$timestamp][$type] $message\n");
    }

    public static function request(string $method, string $url, array $headers, array $payload): void
    {
        self::log('REQUEST', "$method $url");
        self::log('HEADERS', json_encode($headers, JSON_PRETTY_PRINT));
        self::log('PAYLOAD', json_encode($payload, JSON_PRETTY_PRINT));
    }

    public static function query(string $sql, float $time): void
    {
        self::log('QUERY', "$sql (${time}ms)");
    }

    public static function view(string $name, array $data = []): void
    {
        self::log('VIEW', "$name " . json_encode($data, JSON_PRETTY_PRINT));
    }
}