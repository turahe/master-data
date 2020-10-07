<?php

namespace Turahe\Master;

use Illuminate\Support\Facades\Facade as BaseFacade;

class MasterFacade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'master';
    }
}
