@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-9">
                <div class="clearfix"></div>
                @include('flash::message')
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body">
                        @include('event.table')
                    </div>
                </div>
                <div class="text-center">

                    @include('adminlte-templates::common.paginate', ['records' => $collects])

                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{$username}}</h3>
                        <p class="text-muted text-center">Diabloer</p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Ngày bắt đầu</b> <a class="btn btn-warning btn-flat btn-xs pull-right">4h00 23/12/2020</a>
                            </li>
                            <li class="list-group-item">
                                <b>Ngày kết thúc</b> <span class="label label-info pull-right">4h00 05/01/2021</span>
                            </li>
                            <li class="list-group-item">
                                <b>Vật phẩm thu thập</b> <span class="label label-info pull-right">Andrieal Soul</span>
                            </li>
                            <li class="list-group-item">
                                <b>Bạn đang có </b> <span class="label label-info pull-right">{{$point}} Andrieal Soul</span>
                            </li>
                            <li class="list-group-item" style="display: none;">
                                <b>Today Quest</b> <a class="btn btn-danger btn-xs pull-right"
                                                      style="background-color:<?php echo $color?>;border-color:unset">Not
                                    Complete</a>
                            </li>
                        </ul>

                        <a href="https://diablo2-vn.com/event-new-year/" class="btn btn-primary btn-block">
                            <b>Chi tiết và giải thưởng</b>
                        </a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>

@endsection

