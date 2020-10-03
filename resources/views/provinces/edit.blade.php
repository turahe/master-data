@extends(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('Province'),
            'actions' => [
                [
                    'label' => __('Lihat Semua Province'),
                    'class' => '',
                    'icon' => '',
                    'url' => route('indonesia::provinces.index')
                ],
            ]
        ],
    ]
)

@section('content')
    @component('ui::components.panel', ['title' => __('Edit Province')])
        {!! form()->bind($provinsi)->put(route('indonesia::provinsi.update', $provinsi)) !!}
        {!! form()->hidden('previous_id')->value($provinsi->getKey()) !!}
        {!! form()->text('id')->label('Kode')->required() !!}
        {!! form()->text('name')->label('Name')->required() !!}
        {!! form()->action([
            form()->submit('Save'),
            form()->link('Cancel', route('indonesia::provinsi.index'))
        ]) !!}
        {!! form()->close() !!}
    @endcomponent
@endsection
