@extends(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('Desa/Village'),
            'actions' => [
                [
                    'label' => __('Lihat Semua Desa/Village'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::villages.index')
                ],
            ]
        ],
    ]
)

@section('content')
    @component('ui::components.panel', ['title' => __('Tambah Desa/Village')])
        {!! form()->post(route('indonesia::kelurahan.store')) !!}
        {!! form()->text('id')->label('Kode')->required() !!}
        {!! form()->text('name')->label('Nama Desa/Village')->required() !!}
        {!! form()->select('district_id', \Laravolt\Indonesia\Models\District::pluck('name', 'id'))->label('District')->required() !!}
        {!! form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::kelurahan.index'))
        ]) !!}
        {!! form()->close() !!}
    @endcomponent
@endsection
