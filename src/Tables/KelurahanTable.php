<?php

namespace Turahe\Address\Tables;

use Laravolt\Suitable\Columns\Numbering;

class KelurahanTable extends \Laravolt\Suitable\TableView
{
    protected function columns()
    {
        return [
            Numbering::make('No'),
            \Laravolt\Suitable\Columns\Id::make('id', 'Kode')->sortable(),
            \Laravolt\Suitable\Columns\Text::make('name', 'Desa/Village')->sortable(),
            \Laravolt\Suitable\Columns\Text::make('kecamatan.name', 'District')->sortable('kecamatan.name'),
            \Laravolt\Suitable\Columns\RestfulButton::make('indonesia::kelurahan', __('Action'))->except('view'),
        ];
    }
}
