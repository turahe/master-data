<?php

namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Turahe\Master\Models\Province.
 *
 * @property int                             $id
 * @property int                             $country_id
 * @property string                          $name
 * @property string|null                     $region
 * @property string|null                     $iso_3166_2
 * @property string|null                     $region_code
 * @property string|null                     $calling_code
 * @property string|null                     $latitude
 * @property string|null                     $longitude
 * @property int                             $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\City[] $cities
 * @property-read int|null $cities_count
 * @property-read \Turahe\Master\Models\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Master\Models\District[] $districts
 * @property-read int|null $districts_count
 * @property-read string $address
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCallingCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereIso31662($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $code
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCode($value)
 */
class State extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'state_code',
    ];
    protected $table = 'tm_provinces';

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'state_id');
    }

    /**
     * @return HasManyThrough
     */
    public function districts(): HasManyThrough
    {
        return $this->hasManyThrough(District::class, City::class);
    }

    /**
     * @return string
     */
//    public function getLogoPathAttribute(): string
//    {
//        $folder = 'logo/';
//        $id = $this->getAttributeValue('id');
//        $arr_glob = glob(public_path().'/'.$folder.$id.'.*');
//        if (count($arr_glob) == 1) {
//            $logo_name = basename($arr_glob[0]);
//            $logo_path = url($folder.$logo_name);
//
//            return $logo_path;
//        }
//    }

    /**
     * @return string
     */
    public function getAddressAttribute(): string
    {
        return sprintf(
            '%s, Indonesia',
            $this->name
        );
    }
}
