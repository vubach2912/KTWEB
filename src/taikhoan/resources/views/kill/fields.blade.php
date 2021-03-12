<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- charname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('charname', 'Charname:') !!}
    {!! Form::text('charname', null, ['class' => 'form-control']) !!}
</div>

<!-- charname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monster_id', 'Monster_id:') !!}
    {!! Form::text('monster_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('kill.index') }}" class="btn btn-default">Cancel</a>
</div>
