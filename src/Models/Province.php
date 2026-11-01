<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/**
 * Turahe\Master\Models\Province.
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string|null $region
 * @property string|null $iso_3166_2
 * @property string|null $region_code
 * @property string|null $calling_code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|City[] $cities
 * @property-read int|null $cities_count
 * @property-read Country $country
 * @property-read Collection|District[] $districts
 * @property-read int|null $districts_count
 * @property-read string $address
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @property string|null $code
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCode($value)
 */
class Province extends State {}
