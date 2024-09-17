<?php

namespace Turahe\Master;

use Illuminate\Support\Facades\Facade;

class MasterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MasterService::class;
    }
}
