@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Kill</h1>
        <!-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-bottom: 5px" href="#">Add New</a>
        </h1> -->
    </section>
    <div class="content"><br>
    {{-- <h5 style="margin-right:30px;margin-left:30px;" class="pull-left">Số dư còn lại :<span class = "label label-default" style="font-size: 11px;background-color: #f39c12;color: white;"></span></h5>
    <h5>Tổng số dư đã DONATE :<span class = "label label-default" style="font-size: 11px;background-color: #f39c12;color: white;"></span></h5> --}}
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('kill.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection