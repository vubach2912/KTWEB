<div class="table-responsive">
    <table class="table" id="bNETS-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Acct Email</th>
                <th>Auth Lock</th>
                <th>Auth Locktime</th>
                <th>Auth Lockreason</th>
                <th>Auth Command Groups</th>
                <th>Acct Lastlogin Time</th>
                <th>Acct Lastlogin Ip</th>
                <th>Acct Ctime</th>
                <th>Auth Lockby</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bNETS as $bNET)
            <tr>
                <td>{{ $bNET->acct_username }}</td>
                <td>{{ $bNET->acct_email }}</td>
                <td>{{ $bNET->auth_lock }}</td>
                <td>{{ $bNET->auth_locktime }}</td>
                <td>{{ $bNET->auth_lockreason }}</td>
                <td>{{ $bNET->auth_command_groups }}</td>
                <td>{{ $bNET->acct_lastlogin_time }}</td>
                <td>{{ $bNET->acct_lastlogin_ip }}</td>
                <td>{{ $bNET->acct_ctime }}</td>
                <td>{{ $bNET->auth_lockby }}</td>
                <td>
                    {!! Form::open(['route' => ['bnets.destroy', $bNET->uid], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('bnets.show', [$bNET->uid]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('bnets.edit', [$bNET->uid]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
