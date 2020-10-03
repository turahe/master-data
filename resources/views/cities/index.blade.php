@extends(
    config('laravolt.indonesia.view.layout'),
    [
        '__page' => [
            'title' => __('Kota/City'),
            'actions' => [
                [
                    'label' => __('Tambah'),
                    'class' => 'primary',
                    'icon' => 'plus circle',
                    'url' => route('indonesia::cities.create')
                ],
            ]
        ],
    ]
)

@section('content')
    {!! $table !!}
@endsection
