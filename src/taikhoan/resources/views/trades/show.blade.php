@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Trade
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('trades.show_fields')
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Quyết định mua', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('trades.index') }}" class="btn btn-default">Quay về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
