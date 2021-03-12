@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Trade
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($trade, ['route' => ['trades.update', $trade->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('trades.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection