<div class="table-responsive">
    <table class="table" id="tradeAccounts-table">
        <thead>
            <tr>
                <th>Username</th>
        <th>Password</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tradeAccounts as $tradeAccount)
            <tr>
                <td>{{ $tradeAccount->username }}</td>
            <td>{{ $tradeAccount->password }}</td>
            <td>{{ $tradeAccount->status }}</td>
                <td>
                    {!! Form::open(['route' => ['tradeAccounts.destroy', $tradeAccount->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tradeAccounts.show', [$tradeAccount->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tradeAccounts.edit', [$tradeAccount->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
