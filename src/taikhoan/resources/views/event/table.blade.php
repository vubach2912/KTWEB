<div class="table-responsive">
    <h1 class="pull-left text-center">TOP Linh hồ thu thập được</h1>
    <table class="table" id="collects-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        @foreach($collects as $collect)
            <tr>
                <td>{{ $collect->username }}</td>
                <td>{{ $collect->sum_amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
