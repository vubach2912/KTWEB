@extends('layouts.app')

@section('content')
    <br/>
    <section class="content-header">
        <h1 class="pull-left">Lịch sử giao dịch</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('donate') }}">Nạp thêm FGOLD</a>
        </h1>
    </section>
    <div class="content"><br>
        <div class="clearfix"></div>

        @include('flash::message')
        @include('transactions.search')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('transactions.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

