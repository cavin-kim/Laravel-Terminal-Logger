<?php

namespace CavinKim\LaravelTerminalLogger;

class Logger
{
    public function log($message)
    {
        return "Logging: {$message}";
    }
}