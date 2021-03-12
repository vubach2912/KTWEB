@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            B N E T
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'bNETS.store']) !!}

                        @include('b_n_e_t_s.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
