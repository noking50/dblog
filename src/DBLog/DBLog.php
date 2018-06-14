<?php

namespace Noking50\DBLog;

/**
 * DBLog
 * 
 */
class DBLog {

    /**
     * Construct
     * 
     */
    public function __construct() {
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

        logger()->channel(config('dblog.logger_channel'))->info('[' . $action . ']' . json_encode($data));
    }

}
