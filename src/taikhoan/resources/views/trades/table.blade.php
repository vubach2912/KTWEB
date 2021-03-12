<div class="table-responsive">
    <table class="table" id="trades-table">
        <tbody>
        @foreach($trades as $trade)
            <tr>
                <td>
                    {{ $trade->quality }} - {{ $trade->item_type }}
                    <br/>
                    {{ $trade->name }}
                </td>
                <td><img src="{{ $trade->image }}" width="250px"/></td>
                <td>{{ $trade->note }}</td>
                <td>{{ $trade->amount }} <br/> {{ $trade->amount_type }}</td>
                <td>
                    <a href="{{ route('trades.show', [$trade->id]) }}" class='btn btn-primary'>
                        Chọn mua
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<style>
    td {
        line-height: 1.1;
        text-shadow: -1px -1px 0 rgba(0,0,0,.3);
        text-transform: uppercase;
    }

    #trades-table table {
        background-color: transparent;
    }

    #trades-table tr {
        border: 2px solid #323232;
    }

    #trades-table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }
</style>
