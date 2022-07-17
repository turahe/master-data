<?php

namespace Turahe\Master\Database\Schema\Macros;

use Illuminate\Database\Schema\Blueprint;

class RecordStatus
{
    /**
     * Create a new timestamp column on the table.
     *
     * @param Blueprint $table
     * @return \Illuminate\Database\Schema\ColumnDefinition
     */
    public static function column(Blueprint $table)
    {
        return $table->enum('record_status', ['DELETED','ARCHIVED','DRAFT','UNPUBLISHED','PUBLISH']);
    }

}