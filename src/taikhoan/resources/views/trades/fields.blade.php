<!-- Seller Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seller_id', 'Seller Id:') !!}
    {!! Form::number('seller_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Storage Char Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('storage_char_id', 'Storage Char Id:') !!}
    {!! Form::number('storage_char_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('difficulty', 'Difficulty:') !!}
    {!! Form::select('difficulty', ['Normal' => 'Normal'], null, ['class' => 'form-control']) !!}
</div>

<!-- Item Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_type', 'Item Type:') !!}
    {!! Form::select('item_type', ['Armor' => 'Armor'], null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Note Field -->
<div class="form-group col-sm-6">
    {!! Form::label('note', 'Note:') !!}
    {!! Form::text('note', null, ['class' => 'form-control']) !!}
</div>

<!-- Quality Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quality', 'Quality:') !!}
    {!! Form::text('quality', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount_type', 'Amount Type:') !!}
    {!! Form::select('amount_type', ['FGOLD' => 'FGOLD'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('trades.index') }}" class="btn btn-default">Cancel</a>
</div>
