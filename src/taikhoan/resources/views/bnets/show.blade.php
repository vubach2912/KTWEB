@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            B N E T
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('b_n_e_t_s.show_fields')
                    <a href="{{ route('bNETS.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
