@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Thay đổi thông tin tài khoản
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       {!! Form::model($bNET, ['route' => ['bnets.update', $bNET->uid], 'method' => 'patch']) !!}
            @include('bnets.fields')
       {!! Form::close() !!}
   </div>
@endsection
