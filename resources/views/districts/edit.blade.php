@extends(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('District'),
            'actions' => [
                [
                    'label' => __('Lihat Semua District'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::districts.index')
                ],
            ]
        ],
    ]
)

@section('content')
    @component('ui::components.panel', ['title' => __('Edit District')])
        {!! form()->bind($kecamatan)->put(route('indonesia::kecamatan.update', $kecamatan)) !!}
        {!! form()->hidden('previous_id')->value($kecamatan->getKey()) !!}
        {!! form()->text('id')->label('Kode')->required() !!}
        {!! form()->text('name')->label('Nama')->required() !!}
        {!! form()->select('city_id', \Laravolt\Indonesia\Models\City::pluck('name', 'id'))->label('City')->required() !!}
        {!! form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::kecamatan.index'))
        ]) !!}
        {!! form()->close() !!}
    @endcomponent
@endsection
