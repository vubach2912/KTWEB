<div class="table-responsive">
    <table class="table" id="tradeHistories-table">
        <thead>
            <tr>
                <th>Trade Id</th>
        <th>Status</th>
        <th>Username</th>
        <th>Password</th>
        <th>Amount</th>
        <th>Amount Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tradeHistories as $tradeHistory)
            <tr>
                <td>{{ $tradeHistory->trade_id }}</td>
            <td>{{ $tradeHistory->status }}</td>
            <td>{{ $tradeHistory->username }}</td>
            <td>{{ $tradeHistory->password }}</td>
            <td>{{ $tradeHistory->amount }}</td>
            <td>{{ $tradeHistory->amount_type }}</td>
                <td>
                    {!! Form::open(['route' => ['tradeHistories.destroy', $tradeHistory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tradeHistories.show', [$tradeHistory->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tradeHistories.edit', [$tradeHistory->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
