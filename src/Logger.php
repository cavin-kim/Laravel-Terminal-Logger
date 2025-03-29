<?php

namespace CavinKim\LaravelTerminalLogger;

class Logger
{    
    const COLORS = [
        'REQUEST' => "\033[34m", 
        'QUERY'   => "\033[32m",
        'VIEW'    => "\033[35m",
        'RESET'   => "\033[0m",
    ];

    public static function log(string $type, string $message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $color = self::COLORS[$type] ?? self::COLORS['RESET'];
        $output = "\n{$color}[$timestamp][$type] $message" . self::COLORS['RESET'] . "\n";
        fwrite(fopen('php://stderr', 'w'), $output);
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