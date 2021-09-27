<?php

namespace Turahe\Master\Database\Schema\Macros;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\DB;

class UserStampsMacro implements MacroInterface
{
    /**
     * Bootstrap the schema macro.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUserstamps();
        $this->registerSoftUserstamps();
        $this->registerDropUserstamps();
        $this->registerDropSoftUserstamps();
    }

    private function registerUserstamps()
    {
        Blueprint::macro('master', function () {
            if (config('master.users_table_column_type') === 'bigIncrements') {
                $this->unsignedBigInteger(config('master.created_by_column'))->nullable();
                $this->unsignedBigInteger(config('master.updated_by_column'))->nullable();
            } elseif (config('master.users_table_column_type') === 'uuid') {
                $this->uuid(config('master.created_by_column'))->nullable();
                $this->uuid(config('master.updated_by_column'))->nullable();
            } else {
                $this->unsignedInteger(config('master.created_by_column'))->nullable();
                $this->unsignedInteger(config('master.updated_by_column'))->nullable();
            }

            $this->foreign(config('master.created_by_column'))
                ->references(config('master.users_table_column_id_name'))
                ->on(config('master.users_table'))
                ->onDelete('set null');

            $this->foreign(config('master.updated_by_column'))
                ->references(config('master.users_table_column_id_name'))
                ->on(config('master.users_table'))
                ->onDelete('set null');

            return $this;
        });
    }

    private function registerSoftUserstamps()
    {
        Blueprint::macro('softUserstamps', function () {
            if (config('master.users_table_column_type') === 'bigIncrements') {
                $this->unsignedBigInteger(config('master.deleted_by_column'))->nullable();
            } elseif (config('master.users_table_column_type') === 'uuid') {
                $this->uuid(config('master.deleted_by_column'))->nullable();
            } else {
                $this->unsignedInteger(config('master.deleted_by_column'))->nullable();
            }

            $this->foreign(config('master.deleted_by_column'))
                ->references(config('master.users_table_column_id_name'))
                ->on(config('master.users_table'))
                ->onDelete('set null');

            return $this;
        });
    }

    private function registerDropUserstamps()
    {
        Blueprint::macro('dropUserstamps', function () {
            if (! DB::connection() instanceof SQLiteConnection) {
                $this->dropForeign([
                    config('master.created_by_column'),
                ]);
            }

            if (! DB::connection() instanceof SQLiteConnection) {
                $this->dropForeign([
                    config('master.updated_by_column'),
                ]);
            }

            $this->dropColumn([
                config('master.created_by_column'),
                config('master.updated_by_column'),
            ]);
        });
    }

    private function registerDropSoftUserstamps()
    {
        Blueprint::macro('dropSoftUserstamps', function () {
            if (! DB::connection() instanceof SQLiteConnection) {
                $this->dropForeign([
                    config('master.deleted_by_column'),
                ]);
            }

            $this->dropColumn(config('master.deleted_by_column'));
        });
    }
}
