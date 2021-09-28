<?php

namespace Turahe\Master\Traits;

use Turahe\Master\Observers\UserStampObserver;

trait HasUserStamps
{
    /**
     * Bootstrap the trait.
     *
     * @return void
     */
    public static function bootHasUserStamps()
    {
        static::observe(UserStampObserver::class);
    }

    /**
     * Get the user that created the model.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(
            config('master.users_model'),
            config('master.created_by_column'),
            config('master.users_table_column_id_name')
        );
    }

    /**
     * Get the user that edited the model.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function editor()
    {
        return $this->belongsTo(
            config('master.users_model'),
            config('master.updated_by_column'),
            config('master.users_table_column_id_name')
        );
    }

    /**
     * Get the user that deleted the model.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destroyer()
    {
        return $this->belongsTo(
            config('master.users_model'),
            config('master.deleted_by_column'),
            config('master.users_table_column_id_name')
        );
    }

    /**
     * Has the model loaded the SoftDeletes trait.
     *
     * @return bool
     */
    public function usingSoftDeletes()
    {
        return $usingSoftDeletes = in_array(
            'Illuminate\Database\Eloquent\SoftDeletes',
            class_uses_recursive(
                get_called_class()
            )
        );
    }
}
