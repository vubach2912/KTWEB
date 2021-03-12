<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!-- Username Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('acct_username', 'Tên đăng nhập:') !!}
                {!! Form::text('acct_username', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Acct Passhash1 Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('acct_passhash1', 'Mật khẩu:') !!}
                {!! Form::text('acct_passhash1', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Acct Email Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('acct_email', 'Email:') !!}
                {!! Form::email('acct_email', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!-- 'bootstrap / Toggle Switch Auth Lock Field' -->
            <div class="form-group col-sm-12">
                {!! Form::label('auth_lock', 'Khoá tài khoản:') !!}
                <label class="checkbox-inline">
                    {!! Form::hidden('auth_lock', 0) !!}
                    {!! Form::checkbox('auth_lock', 't', null,  ['data-toggle' => 'toggle']) !!}
                </label>
            </div>


            <!-- Auth Locktime Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('auth_locktime', 'Thời gian khoá:') !!}
                {!! Form::text('auth_locktime', null, ['class' => 'form-control','id'=>'auth_locktime']) !!}
            </div>

            @push('scripts')
                <script type="text/javascript">
                    $('#auth_locktime').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss',
                        useCurrent: true,
                        sideBySide: true
                    })
                </script>
            @endpush

            <!-- Auth Lockreason Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('auth_lockreason', 'Lý do bị khoá:') !!}
                {!! Form::text('auth_lockreason', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Auth Lockby Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('auth_lockby', 'Bị khoá bởi:') !!}
                {!! Form::text('auth_lockby', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!-- Auth Command Groups Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('auth_command_groups', 'Kích hoạt chat tổng:') !!}
                {!! Form::select('auth_command_groups', ['Actived' => 'Actived'], null, ['class' => 'form-control']) !!}
            </div>

            <!-- Acct Lastlogin Time Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('acct_lastlogin_time', 'Thời gian đăng nhập cuối:') !!}
                {!! Form::text('acct_lastlogin_time', null, ['class' => 'form-control','id'=>'acct_lastlogin_time']) !!}
            </div>

            @push('scripts')
                <script type="text/javascript">
                    $('#acct_lastlogin_time').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss',
                        useCurrent: true,
                        sideBySide: true
                    })
                </script>
            @endpush

            <!-- Acct Lastlogin Ip Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('acct_lastlogin_ip', 'IP Đăng nhập lần cuối:') !!}
                {!! Form::text('acct_lastlogin_ip', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Acct Ctime Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('acct_ctime', 'Tài khoản được tạo:') !!}
                {!! Form::text('acct_ctime', null, ['class' => 'form-control','id'=>'acct_ctime']) !!}
            </div>

            @push('scripts')
                <script type="text/javascript">
                    $('#acct_ctime').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss',
                        useCurrent: true,
                        sideBySide: true
                    })
                </script>
            @endpush

        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('bnets.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</div>
