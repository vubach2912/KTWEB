<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $tradeHistory->id }}</p>
</div>

<!-- Trade Id Field -->
<div class="form-group">
    {!! Form::label('trade_id', 'Trade Id:') !!}
    <p>{{ $tradeHistory->trade_id }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $tradeHistory->status }}</p>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $tradeHistory->username }}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $tradeHistory->password }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $tradeHistory->amount }}</p>
</div>

<!-- Amount Type Field -->
<div class="form-group">
    {!! Form::label('amount_type', 'Amount Type:') !!}
    <p>{{ $tradeHistory->amount_type }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $tradeHistory->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $tradeHistory->updated_at }}</p>
</div>

