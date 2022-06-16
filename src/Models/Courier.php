<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    8/12/20, 2:20 AM
 *  @name          toko
 * @author         Wachid
 * @copyright      Copyright (c) 2019-2020.
 */

namespace Turahe\Master\Models;

/**
 * Turahe\Master\Models\Courier.
 *
 * @property string                          $id
 * @property string                          $name
 * @property string|null                     $description
 * @property string|null                     $url
 * @property int                             $is_free
 * @property int                             $status
 * @property string|null                     $deleted_at
 * @property int|null                        $created_by
 * @property int|null                        $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereUrl($value)
 * @mixin \Eloquent
 */
class Courier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'url',
        'is_free',
        'cost',
        'status',
    ];
}
