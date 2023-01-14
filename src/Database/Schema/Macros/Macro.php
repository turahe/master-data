<?php
namespace Turahe\Master\Database\Schema\Macros;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\SQLiteConnection;
use Turahe\Master\Contracts\MacroInterface;

/**
 *
 */
class Macro implements MacroInterface
{
    /**
     * Bootstrap the schema macro.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUserStamps();
        $this->registerSoftUserStamps();
        $this->registerDropUserStamps();
        $this->registerDropSoftUserStamps();
        $this->registerRecordStatus();
        $this->registerNestedSet();
    }

    /**
     *
     */
    private function registerUserStamps()
    {
        Blueprint::macro('userStamps', function () {
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

    /**
     *
     */
    private function registerSoftUserStamps()
    {
        Blueprint::macro('softUserStamps', function () {
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

    /**
     *
     */
    private function registerDropUserStamps()
    {
        Blueprint::macro('dropUserStamps', function () {
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

    /**
     *
     */
    private function registerDropSoftUserStamps()
    {
        Blueprint::macro('dropSoftUserStamps', function () {
            if (! DB::connection() instanceof SQLiteConnection) {
                $this->dropForeign([
                    config('master.deleted_by_column'),
                ]);
            }

            $this->dropColumn(config('master.deleted_by_column'));
        });
    }

    /**
     *
     */
    private function registerNestedSet()
    {
        Blueprint::macro('nestedSet', function () {
            NestedSet::columns($this);
        });

        Blueprint::macro('dropNestedSet', function () {
            NestedSet::dropColumns($this);
        });
    }

    /**
     *
     */
    private function registerRecordStatus()
    {
        Blueprint::macro('recordStatus', function () {
            RecordStatus::column($this);
        });
    }
}
