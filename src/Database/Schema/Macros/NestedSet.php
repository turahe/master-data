<?php
namespace Turahe\Master\Database\Schema\Macros;

use Turahe\Master\Traits\NodeTrait;
use Illuminate\Database\Schema\Blueprint;

class NestedSet
{
    /**
     * The name of default record_left column.
     */
    const LFT = 'record_left';

    /**
     * The name of default record_right column.
     */
    const RGT = 'record_right';

    /**
     * The name of default record_dept column.
     */
    const DEPT = 'record_dept';

    /**
     * The name of default record_ordering column.
     */
    const ORDERING = 'record_ordering';

    /**
     * The name of default parent_id column.
     */
    const PARENT_ID = 'parent_id';

    /**
     * Insert direction.
     */
    const BEFORE = 1;

    /**
     * Insert direction.
     */
    const AFTER = 2;

    /**
     * Add default nested set columns to the table. Also create an index.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     */
    public static function columns(Blueprint $table)
    {
        $table->unsignedInteger(self::LFT)->default(0);
        $table->unsignedInteger(self::RGT)->default(0);
        $table->unsignedInteger(self::DEPT)->default(0);
        $table->unsignedInteger(self::ORDERING)->default(0);
        $table->unsignedInteger(self::PARENT_ID)->nullable();

        foreach (static::getDefaultColumns() as $index) {
            $table->index($index);
        }

//        $table->index(static::getDefaultColumns());
    }

    /**
     * Drop NestedSet columns.
     *
     * @param \Illuminate\Database\Schema\Blueprint $table
     */
    public static function dropColumns(Blueprint $table)
    {
        $columns = static::getDefaultColumns();

//        foreach ($columns as $index) {
//            $table->dropIndex($index);
//        }

//        $table->dropIndex($columns);
        $table->dropColumn($columns);
    }

    /**
     * Get a list of default columns.
     *
     * @return array
     */
    public static function getDefaultColumns()
    {
        return [static::LFT, static::RGT, static::PARENT_ID, static::DEPT, static::ORDERING];
    }

    /**
     * Replaces instanceof calls for this trait.
     *
     * @param mixed $node
     *
     * @return bool
     */
    public static function isNode($node)
    {
        return is_object($node) && in_array(NodeTrait::class, (array) $node);
    }
}
