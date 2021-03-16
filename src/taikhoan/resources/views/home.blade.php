@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{$username}}</h3>
                        <p class="text-muted text-center">Lữ hành</p>
                        <ul class="list-group list-group-unbordered">
{{--                            <li class="list-group-item">--}}
{{--                                <b>Đồng trong tài khoản</b> <a class="btn btn-warning btn-flat btn-xs pull-right"> Đồng</a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="false">Cài đặt</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            @include('flash::message')
                            <form class="form-horizontal" method="post" action="/home">
                                @csrf
                                <center>
                                    <div class="form-group">
                                        <h1>ĐỔI MẬT KHẨU</h1>
                                    </div>
                                </center>

                                <div class="form-group">
                                    <label for="inputPass" class="col-sm-2 control-label">Mật khẩu hiện tại</label>

                                    <div class="col-sm-10">
                                        <input type="password" name="old_password" value="{{old('old_password')}}"
                                               class="form-control" id="inputName" placeholder="Current Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPass" class="col-sm-2 control-label">Mật khẩu mới</label>

                                    <div class="col-sm-10">
                                        <input type="password" name="newPassword"
                                               aria-valuetext="{{old('newPassword')}}" class="form-control"
                                               id="inputName" placeholder="New Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPass" class="col-sm-2 control-label">Xác nhận mật khẩu</label>

                                    <div class="col-sm-10">
                                        <input type="password" name="cf_password" value="{{old('cf_password')}}"
                                               class="form-control" id="inputName" placeholder="Confirmed Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="settingPassword" class="btn btn-danger">Thay đổi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
