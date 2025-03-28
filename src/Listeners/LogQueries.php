<?php

namespace CavinKim\LaravelTerminalLogger\Listeners;

use Illuminate\Database\Events\QueryExecuted;

class LogQueries
{
    public function handle(QueryExecuted $event)
    {
        $sql = $event->sql;
        $bindings = json_encode($event->bindings);
        $time = $event->time;

        echo "\n[QUERY] $sql\n";
        echo "[BINDINGS] $bindings\n";
        echo "[TIME] {$time}ms\n";
    }
}