@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Trade Account
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tradeAccount, ['route' => ['tradeAccounts.update', $tradeAccount->id], 'method' => 'patch']) !!}

                        @include('trade_accounts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection