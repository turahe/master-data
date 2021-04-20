<?php

namespace Turahe\Master;

use Illuminate\Support\Facades\Facade;

class Master extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MasterService';
    }
}
