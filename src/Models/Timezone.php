<?php

namespace Turahe\Master\Models;

/**
 * Turahe\Master\Models\Timezone.
 *
 * @property string                          $id
 * @property string|null                     $value
 * @property string|null                     $abbr
 * @property int|null                        $offset
 * @property int|null                        $isdst
 * @property string|null                     $text
 * @property string|null                     $utc
 * @property int                             $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereIsdst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereOffset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereUtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereValue($value)
 * @mixin \Eloquent
 */
class Timezone extends Model
{
    protected $table = 'tm_timezones';
}
