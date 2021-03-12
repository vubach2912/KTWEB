@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Kill
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($kills, ['route' => ['kill.update', $kills->id], 'method' => 'patch']) !!}

                        @include('kill.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection