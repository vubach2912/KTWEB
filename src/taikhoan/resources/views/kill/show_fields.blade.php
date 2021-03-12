<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{{ $kills->username }}</p>
</div>

<!-- Charname Field -->
<div class="form-group">
    {!! Form::label('charname', 'Charname:') !!}
    <p>{{ $kills->charname }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $kills->amount }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $kills->created_at }}</p>
</div>

