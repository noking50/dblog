<?php

namespace Noking50\DBLog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see Noking50\DBLog\DBLog
 */
class DBLog extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'dblog';
    }

}
