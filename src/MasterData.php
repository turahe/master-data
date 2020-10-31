<?php

namespace Turahe\Master;

use Illuminate\Support\Facades\Facade as BaseFacade;

class MasterData extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'master';
    }
}
