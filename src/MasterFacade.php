<?php

namespace Turahe\Master;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Turahe\Master\Models\Country country()
 * @method static \Turahe\Master\Models\Province province()
 * @method static \Turahe\Master\Models\City city()
 * @method static \Turahe\Master\Models\District district()
 * @method static \Turahe\Master\Models\Village village()
 * @method static \Turahe\Master\Models\Bank bank()
 * @method static \Turahe\Master\Models\Currency currency()
 * @method static \Turahe\Master\Models\Language language()
 */
class MasterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'master';
    }
} 