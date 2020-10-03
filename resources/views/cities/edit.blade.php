@extends(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('Kota/City'),
            'actions' => [
                [
                    'label' => __('Lihat Semua Kota/City'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::cities.index')
                ],
            ]
        ],
    ]
)

@section('content')
    @component('ui::components.panel', ['title' => __('Edit Kota/City')])
        {!! form()->bind($kabupaten)->put(route('indonesia::kabupaten.update', $kabupaten)) !!}
        {!! form()->hidden('previous_id')->value($kabupaten->getKey()) !!}
        {!! form()->text('id')->label('Kode')->required() !!}
        {!! form()->text('name')->label('Name')->required() !!}
        {!! form()->select('province_id', \Laravolt\Indonesia\Models\Province::pluck('name', 'id'))->label('Province')->required() !!}
        {!! form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::kabupaten.index'))
        ]) !!}
        {!! form()->close() !!}
    @endcomponent
@stop
