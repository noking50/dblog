<?php

namespace Noking50\DBLog;

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

/**
 * DBLog
 * 
 */
class DBLog {

    private $logger;

    /**
     * Construct
     * 
     */
    public function __construct() {
        $path = config('dblog.path');
        $day = intval(config('dblog.day'));

        $handler = new RotatingFileHandler($path, $day, Logger::INFO);
        $handler->setFormatter(tap(new LineFormatter(null, null, true, true), function ($formatter) {
                    $formatter->includeStacktraces();
                }));
        $this->logger = new Logger('dblog', [$handler]);
    }

    public function write($table, $before, $after) {
        if (!$before && !$after) {
            return;
        }
        $action = 'update';
        if (!$before) {
            $action = 'insert';
        } else if (!$after) {
            $action = 'delete';
        }

        $data = [
            'table' => $table,
            'before' => $before ? $before->toArray() : null,
            'after' => $after ? $after->toArray() : null,
            'ip' => request()->ip(),
            'page' => ['name' => request()->route()->getName(), 'param' => request()->route()->parameters()],
            'user_group' => app('user')->group(),
            'user' => app('user')->id(),
        ];

        $this->logger->info('[' . $action . ']' . json_encode($data));
    }

}
