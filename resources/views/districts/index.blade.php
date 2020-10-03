@extends(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('District'),
            'actions' => [
                [
                    'label' => __('Tambah'),
                    'class' => 'primary',
                    'icon' => 'icon plus circle',
                    'url' => route('indonesia::districts.create')
                ],
            ]
        ],
    ]
)
@section('content')
    {!! $table !!}
@endsection
