<div class="table-responsive">
    <table class="table" id="kills-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>charname</th>
                <th>amount</th>
                <th>Created At</th>
                <!-- <th colspan="3">Action</th> -->
            </tr>
        </thead>
        <tbody>
        @foreach($kills as $kill)
            <tr>
                <td>{{ $kill->username }}</td>
                <td>{{ $kill->charname }}</td>
                <td>{{ $kill->amount }}</td>
                <td>{{ $kill->created_at }}</td>
                <!-- <td>
                    {!! Form::open(['route' => ['kill.destroy', $kill->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('kill.show', [$kill->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('kill.edit', [$kill->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
