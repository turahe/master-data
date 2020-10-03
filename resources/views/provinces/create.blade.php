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
    @component('ui::components.panel', ['title' => __('Tambah Province')])
        {!! form()->post(route('indonesia::provinsi.store')) !!}
        {!! form()->text('id')->label('Kode')->required() !!}
        {!! form()->text('name')->label('Name')->required() !!}
        {!! form()->action([
            form()->submit(__('Save')),
            form()->link(__('Cancel'), route('indonesia::provinsi.index'))
        ]) !!}
        {!! form()->close() !!}
    @endcomponent
@endsection
