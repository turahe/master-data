<?php
namespace Turahe\Master\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Turahe\Master\Models\Bank.
 *
 * @property string                          $id
 * @property string                          $name
 * @property string                          $alias
 * @property string                          $company
 * @property string                          $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bank extends Model
{
    protected $table = 'tm_banks';

    /**
     * Get logo of city
     *
     * @return Attribute
     */
    /**
     * Get the logo's country code.
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('vendor/assets/banks/' . $this->code . '.png'),
        );
    }
}
