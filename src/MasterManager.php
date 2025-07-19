<?php

namespace Turahe\Master;

use Turahe\Master\Models\Bank;
use Turahe\Master\Models\City;
use Turahe\Master\Models\Country;
use Turahe\Master\Models\Currency;
use Turahe\Master\Models\District;
use Turahe\Master\Models\Language;
use Turahe\Master\Models\Province;
use Turahe\Master\Models\Village;

class MasterManager
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function country()
    {
        return new Country();
    }

    public function province()
    {
        return new Province();
    }

    public function city()
    {
        return new City();
    }

    public function district()
    {
        return new District();
    }

    public function village()
    {
        return new Village();
    }

    public function bank()
    {
        return new Bank();
    }

    public function currency()
    {
        return new Currency();
    }

    public function language()
    {
        return new Language();
    }
} 